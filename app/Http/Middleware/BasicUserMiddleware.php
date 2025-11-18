<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BasicUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->isBasicPlan()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Access denied',
                    'message' => 'This feature is only available for BASIC plan users'
                ], 403);
            }

            return redirect()->route('login')->with('error', 'Acesso negado. Este recurso é apenas para usuários do plano básico.');
        }

        return $next($request);
    }
}
