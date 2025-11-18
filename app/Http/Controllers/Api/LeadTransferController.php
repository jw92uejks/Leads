<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadTransferController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService
    ) {}

    public function transferOwnership(Request $request, int $leadId): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para transferir propriedade de leads'
                ], 401);
            }

            $validated = $request->validate([
                'new_owner_id' => 'required|integer|min:1'
            ]);

            $lead = $this->leadService->transferLeadOwnership(
                $leadId,
                $validated['new_owner_id'],
                $user
            );

            return response()->json([
                'success' => true,
                'message' => 'Propriedade do lead transferida com sucesso',
                'data' => [
                    'lead_id' => $lead->id,
                    'new_owner_id' => $lead->broker_id,
                    'responsible_id' => $lead->responsible_id
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Lead não encontrado',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function delegateResponsibility(Request $request, int $leadId): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para delegar responsabilidade de leads'
                ], 401);
            }

            $validated = $request->validate([
                'new_responsible_id' => 'required|integer|exists:brokers,id'
            ]);

            $lead = $this->leadService->delegateLeadResponsibility(
                $leadId,
                $validated['new_responsible_id'],
                $user
            );

            return response()->json([
                'success' => true,
                'message' => 'Responsabilidade do lead delegada com sucesso',
                'data' => [
                    'lead_id' => $lead->id,
                    'owner_id' => $lead->broker_id,
                    'new_responsible_id' => $lead->responsible_id
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Lead não encontrado',
                'message' => $e->getMessage()
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function getLeadsByOwner(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para acessar leads'
                ], 401);
            }

            $validated = $request->validate([
                'owner_id' => 'required|integer|min:1',
                'owner_type' => ['required', Rule::in(['App\\Models\\Broker', 'App\\Models\\Supplier'])]
            ]);

            $leads = $this->leadService->getLeadsByOwner(
                $validated['owner_id'],
                $validated['owner_type']
            );

            return response()->json([
                'success' => true,
                'data' => $leads->load(['owner', 'responsible', 'supplier', 'healthOperator'])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function getLeadsByResponsible(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para acessar leads'
                ], 401);
            }

            $validated = $request->validate([
                'responsible_id' => 'required|integer|exists:brokers,id'
            ]);

            $leads = $this->leadService->getLeadsByResponsible($validated['responsible_id']);

            return response()->json([
                'success' => true,
                'data' => $leads->load(['owner', 'responsible', 'supplier', 'healthOperator'])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function transferBulk(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não autenticado',
                    'message' => 'É necessário estar autenticado para transferir leads'
                ], 401);
            }

            $validated = $request->validate([
                'lead_ids' => 'required|array|min:1',
                'lead_ids.*' => 'integer|min:1',
                'new_owner_id' => 'required|integer|min:1',
                'transfer_type' => 'required|in:responsibility,ownership'
            ]);

            $results = $this->leadService->transferBulkLeads(
                $validated['lead_ids'],
                $validated['new_owner_id'],
                $validated['transfer_type'],
                $user
            );

            $successCount = collect($results)->where('success', true)->count();
            $errorCount = collect($results)->where('success', false)->count();

            return response()->json([
                'success' => $errorCount === 0,
                'message' => "Transferência concluída: {$successCount} sucessos, {$errorCount} erros",
                'data' => [
                    'total_leads' => count($validated['lead_ids']),
                    'success_count' => $successCount,
                    'error_count' => $errorCount,
                    'results' => $results
                ]
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Dados inválidos',
                'message' => $e->getMessage()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Internal error',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }
}
