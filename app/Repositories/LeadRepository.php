<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\LeadRepositoryInterface;
use App\Models\Lead;
use App\Models\LeadInteraction;
use Illuminate\Database\Eloquent\Collection;

class LeadRepository implements LeadRepositoryInterface
{
    public function __construct(
        private readonly Lead $model
    ) {}

    public function findByBrokerId(int $brokerId): Collection
    {
        return $this->model->where('broker_id', $brokerId)->get();
    }

    public function findBySupplierId(int $supplierId): Collection
    {
        return $this->model->where('supplier_id', $supplierId)->get();
    }

    public function findById(int $id): ?Lead
    {
        return $this->model->find($id);
    }

    public function findByIdAndBrokerId(int $id, int $brokerId): ?Lead
    {
        return $this->model->where('id', $id)
            ->where('broker_id', $brokerId)
            ->with(['broker.user', 'supplier', 'responsible.user', 'healthOperator', 'automation'])
            ->first();
    }

    public function findByIdAndSupplierId(int $id, int $supplierId): ?Lead
    {
        return $this->model->where('id', $id)
            ->where('supplier_id', $supplierId)
            ->first();
    }

    public function create(array $attributes): Lead
    {
        $lead = $this->model->create($attributes);
        return $lead->load(['broker.user', 'supplier', 'responsible.user', 'healthOperator', 'automation']);
    }

    public function update(Lead $lead, array $attributes): Lead
    {
        $lead->update($attributes);
        return $lead->fresh(['broker.user', 'supplier', 'responsible.user', 'healthOperator', 'automation']);
    }

    public function delete(Lead $lead): bool
    {
        return $lead->delete();
    }

    public function findByFilters(array $filters): Collection
    {
        $query = $this->model->newQuery();

        foreach ($filters as $field => $value) {
            if ($value !== null) {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function updateStep(int $id, int $fromStep, int $toStep, array $interactionData): bool
    {
        $lead = $this->model->find($id);
        if (!$lead) {
            return false;
        }

        $lead->interactions()->create([
            'from_step' => $fromStep,
            'to_step' => $toStep,
            'description' => $interactionData['description'] ?? null,
            'price' => $interactionData['price'] ?? null,
            'return_date' => $interactionData['return_date'] ?? null,
        ]);

        $updateData = [
            'step' => $toStep
        ];

        if (isset($interactionData['price']) && $interactionData['price'] !== null) {
            $updateData['currentPrice'] = $interactionData['price'];
        }

        if (isset($interactionData['description']) && !empty($interactionData['description'])) {
            $updateData['description'] = $interactionData['description'];
        }

        $lead->fill($updateData);


        return $lead->save();
    }

    public function findByResponsible(int $responsibleId): Collection
    {
        return $this->model->where('responsible_id', $responsibleId)->get();
    }

    public function searchByPhone(int $brokerId, string $phone): Collection
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        return $this->model
            ->where('broker_id', $brokerId)
            ->where('phone', 'like', "%{$cleanPhone}%")
            ->with(['broker', 'responsible', 'healthOperator', 'automation'])
            ->get();
    }

    public function searchByName(int $brokerId, string $name): Collection
    {
        return $this->model
            ->where('broker_id', $brokerId)
            ->where(function($query) use ($name) {
                $query->where('name', 'like', "%{$name}%")->orWhere('corporateName', 'like', "%{$name}%");
            })
            ->with(['broker', 'responsible', 'healthOperator', 'automation'])
            ->get();
    }

    public function searchByEmail(int $brokerId, string $email): Collection
    {
        return $this->model
            ->where('broker_id', $brokerId)
            ->where('email', 'like', "%{$email}%")
            ->with(['broker', 'responsible', 'healthOperator', 'automation'])
            ->get();
    }

    public function findByBrokerIdAndStep(int $brokerId, int $step): Collection
    {
        return $this->model
            ->where('broker_id', $brokerId)
            ->where('step', $step)
            ->with(['broker', 'responsible', 'healthOperator', 'automation'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findByBrokerIdAndIsAutomation(int $brokerId, bool $isAutomation): Collection
    {
        return $this->model
            ->where('broker_id', $brokerId)
            ->where('isAutomation', $isAutomation)
            ->with(['broker', 'responsible', 'healthOperator', 'automation'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
