<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ContactService;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'city' => $this->city,
            'state' => $this->state,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'type' => $this->type?->value,
            'type_label' => app(ContactService::class)->getTypeLabel($this->resource),
            'lifes' => $this->lifes,
            'temperature' => $this->temperature,
            'startPrice' => $this->startPrice,
            'currentPrice' => $this->currentPrice,
            'pricingType' => $this->pricingType,
            'depreciationPercent' => $this->depreciationPercent,
            'depreciationInterval' => $this->depreciationInterval,
            'status' => $this->status?->value,
            'status_label' => $this->status?->label(),
            'source' => $this->source?->value,
            'source_label' => $this->source?->label(),
            'step' => $this->step,
            'isAutomation' => $this->isAutomation,
            'acceptContestation' => $this->acceptContestation,
            'description' => $this->description,
            'notes' => $this->notes,
            'lead_expires_at' => $this->lead_expires_at?->format('d/m/Y H:i'),
            'acquired_at' => $this->acquired_at?->format('d/m/Y H:i'),
            'last_contact_at' => $this->last_contact_at?->format('d/m/Y H:i'),
            'converted_at' => $this->converted_at?->format('d/m/Y H:i'),
            'conversion_reason' => $this->conversion_reason,
            'broker' => $this->whenLoaded('broker', function () {
                return [
                    'id' => $this->broker->id,
                    'name' => $this->broker->name,
                ];
            }),
            'supplier' => $this->whenLoaded('supplier', function () {
                return [
                    'id' => $this->supplier->id,
                    'name' => $this->supplier->name,
                ];
            }),
            'responsible' => $this->whenLoaded('responsible', function () {
                return [
                    'id' => $this->responsible->id,
                    'name' => $this->responsible->name,
                ];
            }),
            'health_operator' => $this->whenLoaded('healthOperator', function () {
                return [
                    'id' => $this->healthOperator->id,
                    'name' => $this->healthOperator->name,
                ];
            }),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
        ];
    }
}
