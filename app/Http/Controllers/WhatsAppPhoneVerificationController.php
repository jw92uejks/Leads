<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatsAppPhoneVerificationRequest;
use App\Models\WhatsAppTokenCache;
use App\Repositories\WhatsAppAuthRepository;
use App\Services\WhatsAppAuthService;
use App\Services\WhatsAppSecurityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Laravel\Sanctum\PersonalAccessToken;

class WhatsAppPhoneVerificationController extends Controller
{
    public function __construct(
        private readonly WhatsAppAuthRepository $authRepository,
        private readonly WhatsAppSecurityService $securityService
    ) {}

    public function show(Request $request): View|RedirectResponse
    {
        $encodedToken = $request->query('token');

        if (!$encodedToken) {
            return redirect()->route('login')->with('error', 'Token não fornecido.');
        }

        try {
            $token = WhatsAppAuthService::decodeTokenFromUrl($encodedToken);
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Token inválido.');
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            return redirect()->route('login')->with('error', 'Token inválido ou expirado.');
        }

        $user = $accessToken->tokenable;

        return view('mobile.whatsapp.verify-phone', [
            'token' => $encodedToken,
            'userName' => $user->name,
            'userPhone' => $user->phone,
        ]);
    }

    public function verify(WhatsAppPhoneVerificationRequest $request): RedirectResponse
    {
        $encodedToken = $request->input('token');
        $phone = $request->input('phone');
        $deviceFingerprint = $request->input('device_fingerprint');

        if (empty($deviceFingerprint)) {
            $deviceFingerprint = 'auto-' . md5($request->ip() . $request->userAgent() . now()->timestamp);
            Log::warning('WhatsApp Phone Verification: Fingerprint empty, generated automatic', [
                'generated_fingerprint' => $deviceFingerprint,
                'ip' => $request->ip(),
            ]);
        }

        try {
            $token = WhatsAppAuthService::decodeTokenFromUrl($encodedToken);
        } catch (\Exception $e) {
            return back()->withErrors(['phone' => 'Token inválido.']);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            return back()->withErrors(['phone' => 'Token inválido ou expirado.']);
        }

        $user = $accessToken->tokenable;

        $cache = WhatsAppTokenCache::where('encoded_token', $encodedToken)
            ->where('user_id', $user->id)
            ->first();

        if (!$cache) {
            Log::error('WhatsApp Phone Verification: Cache not found', [
                'user_id' => $user->id,
                'token' => substr($encodedToken, 0, 20) . '...',
            ]);
            return back()->withErrors(['phone' => 'Cache do token não encontrado.']);
        }

        if ($user->isWhatsAppVerified()) {
            return redirect()->route('whatsapp.leads', ['token' => $encodedToken])
                ->with('info', 'Telefone já verificado anteriormente.');
        }

        $normalizedInputPhone = preg_replace('/\D/', '', $phone);

        if (strlen($normalizedInputPhone) === 11) {
            $normalizedInputPhone = '55' . $normalizedInputPhone;
        }

        $normalizedUserPhone = preg_replace('/\D/', '', $user->phone);
        if (strlen($normalizedUserPhone) === 11) {
            $normalizedUserPhone = '55' . $normalizedUserPhone;
        }

        if ($normalizedInputPhone !== $normalizedUserPhone) {
            Log::warning('WhatsApp Phone Verification: Phone mismatch', [
                'user_id' => $user->id,
                'expected' => $normalizedUserPhone,
                'received' => $normalizedInputPhone,
            ]);

            return back()->withErrors(['phone' => 'O número de telefone não corresponde ao cadastrado.'])
                ->withInput();
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            Log::warning('WhatsApp Phone Verification: Senha incorreta', [
                'user_id' => $user->id,
                'phone' => $normalizedInputPhone,
            ]);

            return back()->withErrors(['password' => 'Senha incorreta.'])
                ->withInput(['phone']);
        }

        if (!$user->isWhatsAppVerified()) {
            $this->securityService->saveFirstVerification($user, $normalizedInputPhone, $deviceFingerprint);
        } else {
            $suspicious = $this->securityService->detectSuspiciousAttempt($user, $normalizedInputPhone, $deviceFingerprint);

            if ($suspicious['is_suspicious']) {
                $this->securityService->blockAccess($cache, $suspicious['reason']);

                Log::warning('WhatsApp Phone Verification: Suspicious attempt detected', [
                    'user_id' => $user->id,
                    'reason' => $suspicious['reason'],
                    'phone_match' => $suspicious['phone_match'],
                    'device_match' => $suspicious['device_match'],
                ]);

                return back()->withErrors(['phone' => 'Dispositivo não autorizado. Acesse o perfil para autorizar este dispositivo.']);
            }
        }

        return redirect()->route('whatsapp.leads', ['token' => $encodedToken])
            ->with('success', 'Telefone verificado com sucesso!');
    }
}


