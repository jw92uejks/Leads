<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lead\LeadApiStoreRequest;
use App\Http\Requests\Lead\LeadApiUpdateRequest;
use App\Http\Resources\LeadResource;
use App\Services\LeadService;
use App\Services\LeadLimitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadApiController extends Controller
{
    public function __construct(
        private readonly LeadService $leadService,
        private readonly LeadLimitService $leadLimitService
    ) {}

    public function store(LeadApiStoreRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'error' => 'User not authenticated',
                    'message' => 'User must be authenticated to create leads'
                ], 401);
            }

            if ($user->isBasicPlan() && !$this->leadLimitService->canCreateMoreLeads($user)) {
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
                    'message' => 'This user does not have permission to create leads'
                ], 403);
            }

            $lead = $this->leadService->createLeadViaApi($request->validated(), $user);

            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully!',
                'data' => new LeadResource($lead)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error creating lead',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access leads'
                ], 403);
            }

            $filters = $request->get('filter', []);
            $leads = $this->leadService->getLeadsWithFilters($filters, $user);

            return response()->json([
                'success' => true,
                'data' => [
                    'leads' => LeadResource::collection($leads->items()),
                    'pagination' => [
                        'current_page' => $leads->currentPage(),
                        'last_page' => $leads->lastPage(),
                        'per_page' => $leads->perPage(),
                        'total' => $leads->total()
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to access leads'
                ], 403);
            }

            $lead = $this->leadService->getLeadByIdAndBroker($id, $user);

            return response()->json([
                'success' => true,
                'data' => new LeadResource($lead)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching lead',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 404);
        }
    }

    public function update(LeadApiUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to update leads'
                ], 403);
            }

            $lead = $this->leadService->updateLead($id, $request->validated(), $user);

            return response()->json([
                'success' => true,
                'message' => 'Lead updated successfully',
                'data' => new LeadResource($lead)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error updating lead',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user || !$user->broker) {
                return response()->json([
                    'error' => 'User without permission',
                    'message' => 'This user does not have permission to delete leads'
                ], 403);
            }

            $deleted = $this->leadService->deleteLead($id, $user);

            return response()->json([
                'success' => true,
                'message' => 'Lead deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error deleting lead',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function searchByPhone(Request $request): JsonResponse
    {
        $phone = $request->query('phone');

        if (!$phone) {
            return response()->json([
                'error' => 'Missing parameter',
                'message' => 'O parâmetro "phone" é obrigatório.'
            ], 400);
        }

        try {
            $user = $request->user();
            $leads = $this->leadService->searchByPhone($phone, $user);

            return response()->json([
                'success' => true,
                'data' => LeadResource::collection($leads)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error searching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function searchByName(Request $request): JsonResponse
    {
        $name = $request->query('name');

        if (!$name) {
            return response()->json([
                'error' => 'Missing parameter',
                'message' => 'O parâmetro "name" é obrigatório.'
            ], 400);
        }

        try {
            $user = $request->user();
            $leads = $this->leadService->searchByName($name, $user);

            return response()->json([
                'success' => true,
                'data' => LeadResource::collection($leads)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error searching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function searchByEmail(Request $request): JsonResponse
    {
        $email = $request->query('email');

        if (!$email) {
            return response()->json([
                'error' => 'Missing parameter',
                'message' => 'O parâmetro "email" é obrigatório.'
            ], 400);
        }

        try {
            $user = $request->user();
            $leads = $this->leadService->searchByEmail($email, $user);

            return response()->json([
                'success' => true,
                'data' => LeadResource::collection($leads)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error searching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function byStep(Request $request): JsonResponse
    {
        $step = $request->query('step');

        if (!$step) {
            return response()->json([
                'error' => 'Missing parameter',
                'message' => 'O parâmetro "step" é obrigatório.'
            ], 400);
        }

        try {
            $user = $request->user();
            $leads = $this->leadService->getLeadsByStep((int) $step, $user);

            return response()->json([
                'success' => true,
                'data' => LeadResource::collection($leads),
                'meta' => [
                    'step' => (int) $step,
                    'total' => $leads->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }

    public function byIsAutomation(Request $request): JsonResponse
    {
        $isAutomation = $request->query('is_automation');

        if ($isAutomation === null) {
            return response()->json([
                'error' => 'Missing parameter',
                'message' => 'O parâmetro "is_automation" é obrigatório.'
            ], 400);
        }

        try {
            $user = $request->user();
            $isAutomationBool = filter_var($isAutomation, FILTER_VALIDATE_BOOLEAN);
            $leads = $this->leadService->getLeadsByIsAutomation($isAutomationBool, $user);

            return response()->json([
                'success' => true,
                'data' => LeadResource::collection($leads),
                'meta' => [
                    'is_automation' => $isAutomationBool,
                    'total' => $leads->count()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching leads',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 500);
        }
    }
}
