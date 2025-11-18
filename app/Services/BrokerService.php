<?php

namespace App\Services;

use App\Models\Broker;
use App\Models\Subscription;
use App\Interfaces\BrokerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BrokerService
{
    public function __construct(
        private readonly BrokerRepositoryInterface $brokerRepository
    ) {}

    public function createBrokerForUser(int $userId, ?int $subscriptionId = null): Broker
    {
        $subscription = $this->getDefaultSubscription($subscriptionId);

        if (!$subscription) {
            throw new \Exception('Nenhuma assinatura padrão encontrada');
        }

        $expiresAt = now()->addDays($subscription->durationDays ?? 30);

        return $this->brokerRepository->createWithSubscription(
            $userId,
            $subscription->id,
            $expiresAt
        );
    }

    public function getBrokerByUserId(int $userId): ?Broker
    {
        return $this->brokerRepository->findByUserId($userId);
    }

    public function updateBrokerSubscription(int $brokerId, int $subscriptionId): bool
    {
        $subscription = Subscription::find($subscriptionId);

        if (!$subscription) {
            throw new \Exception('Assinatura não encontrada');
        }

        $expiresAt = now()->addDays($subscription->durationDays ?? 30);

        return $this->brokerRepository->update($brokerId, [
            'subscription_id' => $subscriptionId,
            'subscription_expires_at' => $expiresAt,
        ]);
    }

    public function getAllBrokers(): Collection
    {
        return $this->brokerRepository->getAll();
    }

    public function deleteBroker(int $brokerId): bool
    {
        return $this->brokerRepository->delete($brokerId);
    }

    private function getDefaultSubscription(?int $subscriptionId = null): ?Subscription
    {
        if ($subscriptionId) {
            return Subscription::find($subscriptionId);
        }

        $individualSubscription = Subscription::where('plan_type', 'individual')->first();

        if ($individualSubscription) {
            return $individualSubscription;
        }

        return Subscription::first();
    }
}


