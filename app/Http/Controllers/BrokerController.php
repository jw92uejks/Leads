<?php

namespace App\Http\Controllers;

use App\Http\Requests\Broker\UpdateSubscriptionRequest;
use App\Http\Resources\BrokerResource;
use App\Services\BrokerService;
use Illuminate\Http\JsonResponse;

class BrokerController extends Controller
{
    public function __construct(
        private readonly BrokerService $brokerService
    ) {}

    public function index(): JsonResponse
    {
        $brokers = $this->brokerService->getAllBrokers();
        return response()->json($brokers);
    }

    public function show(int $id): JsonResponse
    {
        $broker = $this->brokerService->getBrokerByUserId($id);

        if (!$broker) {
            return response()->json(['error' => 'Broker não encontrado'], 404);
        }

        return response()->json(new BrokerResource($broker));
    }

    public function updateSubscription(UpdateSubscriptionRequest $request, int $brokerId): JsonResponse
    {
        try {
            $this->brokerService->updateBrokerSubscription(
                $brokerId,
                $request->subscription_id
            );

            return response()->json(['message' => 'Assinatura atualizada com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->brokerService->deleteBroker($id);
            return response()->json(['message' => 'Broker removido com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}


