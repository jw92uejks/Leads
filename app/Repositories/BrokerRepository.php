<?php

namespace App\Repositories;

use App\Interfaces\BrokerRepositoryInterface;
use App\Models\Broker;
use Illuminate\Database\Eloquent\Collection;

class BrokerRepository implements BrokerRepositoryInterface
{
    public function create(array $data): Broker
    {
        return Broker::create($data);
    }

    public function findById(int $id): ?Broker
    {
        return Broker::find($id);
    }

    public function findByUserId(int $userId): ?Broker
    {
        return Broker::where('user_id', $userId)->first();
    }

    public function update(int $id, array $data): bool
    {
        $broker = $this->findById($id);
        if (!$broker) {
            return false;
        }

        return $broker->update($data);
    }

    public function delete(int $id): bool
    {
        $broker = $this->findById($id);
        if (!$broker) {
            return false;
        }

        return $broker->delete();
    }

    public function getAll(): Collection
    {
        return Broker::all();
    }

    public function createWithSubscription(int $userId, int $subscriptionId, \DateTimeInterface|string|null $expiresAt = null): Broker
    {
        return Broker::create([
            'user_id' => $userId,
            'subscription_id' => $subscriptionId,
            'subscription_expires_at' => $expiresAt,
        ]);
    }
}


