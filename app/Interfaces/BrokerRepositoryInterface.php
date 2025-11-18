<?php

namespace App\Interfaces;

use App\Models\Broker;
use Illuminate\Database\Eloquent\Collection;

interface BrokerRepositoryInterface
{
    public function create(array $data): Broker;
    public function findById(int $id): ?Broker;
    public function findByUserId(int $userId): ?Broker;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function getAll(): Collection;
    public function createWithSubscription(int $userId, int $subscriptionId, \DateTimeInterface|string|null $expiresAt = null): Broker;
}


