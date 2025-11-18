<?php

namespace App\Http\Middleware;

use App\Services\LeadLimitService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LeadLimitMiddleware
{
    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            return redirect()->route('login');
        }

        if (!$this->leadLimitService->canCreateMoreLeads($user)) {
            if ($request->expectsJson()) {
                $limitInfo = $this->leadLimitService->getLeadLimitInfo($user);
                return response()->json([
                    'error' => 'Lead limit exceeded',
                    'message' => $this->getLimitMessage($limitInfo),
                    'limit_info' => $limitInfo,
                    'upgrade_required' => true
                ], 403);
            }

            return redirect()->back()->with('error', $this->getLimitMessage($this->leadLimitService->getLeadLimitInfo($user)));
        }

        return $next($request);
    }

    private function getLimitMessage(array $limitInfo): string
    {
        if ($limitInfo['is_basic_user']) {
            return 'Usuários do plano básico podem ter no máximo 100 leads. Faça upgrade para acessar mais leads.';
        }

        if ($limitInfo['is_individual_plan']) {
            return 'Plano Individual permite no máximo 100 leads. Faça upgrade para acessar mais leads.';
        }

        if ($limitInfo['is_teams_plan']) {
            return 'Plano por Equipe permite no máximo 150 leads. Faça upgrade para acessar mais leads.';
        }

        if ($limitInfo['is_enterprise_plan']) {
            return 'Plano Empresarial permite no máximo 200 leads. Entre em contato com o suporte para mais informações.';
        }

        return 'Limite de leads atingido. Entre em contato com o suporte.';
    }
}
