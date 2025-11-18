<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadAutomationStoreRequest;
use App\Http\Requests\LeadAutomationUpdateRequest;
use App\Http\Resources\LeadAutomationResource;
use App\Services\LeadAutomationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeadAutomationApiController extends Controller
{
    public function __construct(
        private readonly LeadAutomationService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $automations = $this->service->getAllByBroker($user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $automation = $this->service->findByIdAndBroker($id, $user->broker->id);

        if (!$automation) {
            return response()->json([
                'message' => 'Automação não encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new LeadAutomationResource($automation)
        ]);
    }

    public function store(LeadAutomationStoreRequest $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to create automations'
            ], 403);
        }

        $automation = $this->service->createForBroker($request->validated(), $user->broker->id);

        if (!$automation) {
            return response()->json([
                'error' => 'Lead not found or not accessible',
                'message' => 'The lead does not exist or does not belong to this broker'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Automação criada com sucesso.',
            'data' => new LeadAutomationResource($automation)
        ], 201);
    }

    public function update(LeadAutomationUpdateRequest $request, int $id): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to update automations'
            ], 403);
        }

        $automation = $this->service->updateForBroker($id, $request->validated(), $user->broker->id);

        if (!$automation) {
            return response()->json([
                'message' => 'Automação não encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Automação atualizada com sucesso.',
            'data' => new LeadAutomationResource($automation)
        ]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to delete automations'
            ], 403);
        }

        $deleted = $this->service->deleteForBroker($id, $user->broker->id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Automação não encontrada.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Automação deletada com sucesso.'
        ], 200);
    }

    public function byLead(Request $request, int $leadId): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $automation = $this->service->findByLeadIdAndBroker($leadId, $user->broker->id);

        if (!$automation) {
            return response()->json([
                'message' => 'Nenhuma automação encontrada para este lead.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new LeadAutomationResource($automation)
        ]);
    }

    public function byStatus(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $status = $request->query('status');
        $automations = $this->service->getByAssistStatusAndBroker($status, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function upcomingRenewals(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $days = $request->query('days', 30);
        $automations = $this->service->getUpcomingRenewalsByBroker($days, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function upcomingPayments(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $days = $request->query('days', 7);
        $automations = $this->service->getUpcomingPaymentsByBroker($days, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function birthdaysInMonth(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $month = $request->query('month', now()->month);
        $year = $request->query('year', now()->year);
        $automations = $this->service->getBirthdaysInMonthByBroker($month, $year, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function periodicContactsDue(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $automations = $this->service->getPeriodicContactsDueByBroker($user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function searchByPhone(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $phone = $request->query('phone');

        if (!$phone) {
            return response()->json([
                'message' => 'O parâmetro "phone" é obrigatório.'
            ], 400);
        }

        $automations = $this->service->searchByPhoneAndBroker($phone, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }

    public function searchByName(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user || !$user->broker) {
            return response()->json([
                'error' => 'User without permission',
                'message' => 'This user does not have permission to access automations'
            ], 403);
        }

        $name = $request->query('name');

        if (!$name) {
            return response()->json([
                'message' => 'O parâmetro "name" é obrigatório.'
            ], 400);
        }

        $automations = $this->service->searchByNameAndBroker($name, $user->broker->id);

        return response()->json([
            'success' => true,
            'data' => LeadAutomationResource::collection($automations)
        ]);
    }
}

