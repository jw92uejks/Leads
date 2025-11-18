<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BrokerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !method_exists($user, 'isBroker') || !$user->isBroker()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Acesso negado. Apenas corretores podem acessar este recurso.'], 403);
            }

            return redirect()->route('login')->with('error', 'Acesso negado. Apenas corretores podem acessar este recurso.');
        }

        return $next($request);
    }
}


