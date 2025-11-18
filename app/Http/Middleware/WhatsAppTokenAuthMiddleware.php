<?php

namespace App\Http\Middleware;

use App\Models\WhatsAppTokenCache;
use App\Services\WhatsAppAuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class WhatsAppTokenAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->isMobileDevice($request)) {
            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Este link deve ser acessado apenas através de um dispositivo móvel (celular ou tablet).'
            ], 403);
        }

        $encodedToken = $request->query('token');

        if (!$encodedToken) {
            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Acesso não autorizado. Este link deve ser acessado através do WhatsApp.'
            ], 401);
        }

        try {
            $token = WhatsAppAuthService::decodeTokenFromUrl($encodedToken);
        } catch (\Exception $e) {
            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Token inválido. Solicite um novo link através do WhatsApp.'
            ], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Token inválido ou expirado. Solicite um novo link através do WhatsApp.'
            ], 401);
        }

        if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Token expirado. Solicite um novo link através do WhatsApp.'
            ], 401);
        }

        $cache = WhatsAppTokenCache::where('encoded_token', $encodedToken)
            ->where('personal_access_token_id', $accessToken->id)
            ->first();

        if (!$cache) {
            Log::warning('WhatsApp Token Middleware: Cache not found', [
                'token_id' => $accessToken->id,
                'encoded_token' => substr($encodedToken, 0, 20) . '...'
            ]);

            return response()->view('errors.whatsapp-unauthorized', [
                'message' => 'Cache do token não encontrado. Solicite um novo link.'
            ], 401);
        }

        return $next($request);
    }

    private function isMobileDevice(Request $request): bool
    {
        $userAgent = $request->header('User-Agent', '');

        $mobilePatterns = [
            '/android/i',
            '/iphone/i',
            '/ipad/i',
            '/ipod/i',
            '/windows phone/i',
            '/blackberry/i',
            '/mobile/i',
            '/webos/i',
            '/opera mini/i',
            '/opera mobi/i',
        ];

        foreach ($mobilePatterns as $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return true;
            }
        }

        return false;
    }
}

