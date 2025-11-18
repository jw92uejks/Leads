<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanManageTeamsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login');
        }

        if (!$user->canManageTeams()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Access denied',
                    'message' => 'Usuários do plano básico não podem criar ou gerenciar equipes. Faça upgrade do seu plano para acessar todas as funcionalidades.',
                    'upgrade_required' => true
                ], 403);
            }

            return redirect()->route('team-panel.index')->with('error', 'Você não tem permissão para criar ou gerenciar equipes. Faça upgrade do seu plano.');
        }

        return $next($request);
    }
}
