<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\LeadStoreRequest;
use App\Services\LeadService;
use App\Services\LeadLimitService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ManageLeadsController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService,
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function index()
    {
        return view('pclient.manage-leads.index');
    }

    public function store(LeadStoreRequest $request): JsonResponse
    {
        $user = $request->user();

        if ($user->isBasicPlan() && !$this->leadLimitService->canCreateMoreLeads($user)) {
            $limitInfo = $this->leadLimitService->getLeadLimitInfo($user);
            return response()->json([
                'error' => 'Limite de leads excedido',
                                    'message' => 'Usuários do plano básico podem gerenciar até 100 leads. Você atingiu seu limite. Faça upgrade do seu plano para gerenciar mais leads.',
                'limit_info' => $limitInfo
            ], 403);
        }

        try {
            $lead = $this->leadService->createLead($request->validated(), $user);

            return response()->json([
                'message' => 'Lead criado com sucesso',
                'lead' => $lead
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar lead',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function uploadTemplate()
    {
        // Implementar download do template
        return response()->download(storage_path('templates/leads-template.xlsx'));
    }
}