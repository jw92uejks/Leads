<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function findByBrokerId(int $brokerId): Collection;
    public function findBySupplierId(int $supplierId): Collection;
    public function findById(int $id): ?Lead;
    public function findByIdAndBrokerId(int $id, int $brokerId): ?Lead;
    public function findByIdAndSupplierId(int $id, int $supplierId): ?Lead;
    public function create(array $attributes): Lead;
    public function update(Lead $lead, array $attributes): Lead;
    public function delete(Lead $lead): bool;
    public function findByFilters(array $filters): Collection;
    public function updateStep(int $id, int $fromStep, int $toStep, array $interactionData): bool;
    public function findByResponsible(int $responsibleId): Collection;
    public function searchByPhone(int $brokerId, string $phone): Collection;
    public function searchByName(int $brokerId, string $name): Collection;
    public function searchByEmail(int $brokerId, string $email): Collection;
    public function findByBrokerIdAndStep(int $brokerId, int $step): Collection;
    public function findByBrokerIdAndIsAutomation(int $brokerId, bool $isAutomation): Collection;
}