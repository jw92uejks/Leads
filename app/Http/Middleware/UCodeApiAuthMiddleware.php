<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\LeadLimitService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UCodeApiAuthMiddleware
{
    public function __construct(
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $ucode = $request->header('apiKey') ?? $request->query('apiKey');

        if (!$ucode) {
            return response()->json([
                'error' => 'API key not provided',
                'message' => 'It is necessary to provide the apiKey header or apiKey parameter'
            ], 401);
        }

        $user = User::where('ucode', $ucode)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key was not found in the system'
            ], 401);
        }

        if ($this->isCreatingLead($request) && $user->isBasicPlan() && !$this->leadLimitService->canCreateMoreLeads($user)) {
            $limitInfo = $this->leadLimitService->getLeadLimitInfo($user);
            return response()->json([
                'error' => 'Lead limit exceeded',
                'message' => 'BASIC plan users can manage up to 100 leads. You have reached your limit. Upgrade your plan to manage more leads.',
                'limit_info' => $limitInfo
            ], 403);
        }

        if (!$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access the API'
            ], 403);
        }

        $request->merge(['authenticated_user' => $user]);
        $request->setUserResolver(fn() => $user);

        return $next($request);
    }

    private function isCreatingLead(Request $request): bool
    {
        return $request->isMethod('POST') &&
               str_contains($request->path(), 'leads') &&
               !str_contains($request->path(), 'transfer') &&
               !str_contains($request->path(), 'search') &&
               !str_contains($request->path(), 'by-');
    }
}
