<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiWebAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            \Log::warning('ApiWebAuthMiddleware - Usuário não autenticado', [
                'session_data' => $request->session()->all(),
                'has_session_cookie' => $request->cookies->has(config('session.cookie')),
            ]);

            return response()->json([
                'error' => 'Usuário não autenticado',
                'message' => 'Para acessar esta funcionalidade, você precisa estar logado.',
                'redirect' => route('login')
            ], 401);
        }

        if (Auth::check()) {
            $user = Auth::user();


            if (!$user->broker) {
                \Log::error('ApiWebAuthMiddleware - Usuário sem broker');
                return response()->json([
                    'error' => 'Usuário não possui corretor associado',
                    'message' => 'Para acessar esta funcionalidade, o usuário deve ter um corretor associado'
                ], 403);
            }
        }

        return $next($request);
    }
}