<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PremiumAccessMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || $user->isBasicPlan()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Premium feature',
                    'message' => 'This feature requires a premium account. Upgrade your plan to access this functionality.'
                ], 403);
            }

            return redirect()->route('upgrade')->with('error', 'Esta funcionalidade requer uma conta premium. Faça upgrade do seu plano para acessar esta funcionalidade.');
        }

        return $next($request);
    }
}
