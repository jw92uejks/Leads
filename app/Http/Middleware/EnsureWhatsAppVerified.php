<?php

namespace App\Http\Middleware;

use App\Models\WhatsAppTokenCache;
use App\Services\WhatsAppAuthService;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class EnsureWhatsAppVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $encodedToken = $request->query('token') ?? $request->input('token');

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

        if (!$user->isWhatsAppVerified()) {
            return redirect()->route('whatsapp.verify-phone.show', ['token' => $encodedToken])
                ->with('error', 'Você precisa verificar seu telefone antes de acessar.');
        }

        return $next($request);
    }
}

