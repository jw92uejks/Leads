<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactApiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'corporateName' => $this->corporateName,
            'phone' => $this->phone,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'city' => $this->city,
            'state' => $this->state,
            'type' => $this->type?->value,
            'type_label' => $this->type?->label(),
            'status' => $this->status?->value,
            'status_label' => $this->status?->label(),
            'temperature' => $this->temperature,
            'source' => $this->source?->value,
            'isAutomation' => $this->isAutomation,
            'lifes' => $this->lifes,
            'acceptContestation' => $this->acceptContestation,
            'description' => $this->description,
            'startPrice' => $this->startPrice,
            'currentPrice' => $this->currentPrice,
            'pricingType' => $this->pricingType,
            'depreciationPercent' => $this->depreciationPercent,
            'depreciationInterval' => $this->depreciationInterval,
            'step' => $this->step,
            'lead_expires_at' => $this->lead_expires_at?->format('Y-m-d H:i:s'),
            'acquired_at' => $this->acquired_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'supplier' => $this->whenLoaded('supplier', function () {
                return [
                    'id' => $this->supplier->id,
                    'name' => $this->supplier->name,
                ];
            }),
            'broker' => $this->whenLoaded('broker', function () {
                return [
                    'id' => $this->broker->id,
                    'user' => [
                        'name' => $this->broker->user->name,
                        'email' => $this->broker->user->email,
                        'ucode' => $this->broker->user->ucode,
                        'phone' => $this->broker->user->phone,
                    ],
                ];
            }),
            'responsible' => $this->whenLoaded('responsible', function () {
                return [
                    'id' => $this->responsible->id,
                    'user' => [
                        'name' => $this->responsible->name,
                        'email' => $this->responsible->email,
                        'ucode' => $this->responsible->ucode ?? null,
                        'phone' => $this->responsible->phone,
                    ],
                ];
            }),
            'healthOperator' => $this->whenLoaded('healthOperator', function () {
                return [
                    'id' => $this->healthOperator->id,
                    'name' => $this->healthOperator->name,
                ];
            }),
        ];
    }

    private function calculatePriceDepreciation(): ?float
    {
        if (!$this->startPrice || !$this->depreciationPercent || !$this->depreciationInterval || !$this->created_at) {
            return null;
        }

        $daysSinceCreated = $this->created_at->diffInDays(now());
        $depreciationCycles = floor($daysSinceCreated / $this->depreciationInterval);

        if ($depreciationCycles <= 0) {
            return 0;
        }

        $totalDepreciation = $depreciationCycles * ($this->depreciationPercent / 100);
        $maxDepreciation = min($totalDepreciation, 1);

        return round($this->startPrice * $maxDepreciation, 2);
    }

    private function isConversionEligible(): bool
    {
        if ($this->converted_at) {
            return false;
        }

        if ($this->status && $this->status->value !== 'active') {
            return false;
        }

        if ($this->lead_expires_at && $this->lead_expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public function with(Request $request): array
    {
        return [
            'api_version' => 'v1',
            'timestamp' => now()->format('Y-m-d H:i:s')
        ];
    }
}
