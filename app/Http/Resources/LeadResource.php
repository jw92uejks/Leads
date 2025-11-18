<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'supplier_id' => $this->supplier_id,
            'broker_id' => $this->broker_id,
            'responsible_id' => $this->responsible_id,
            'health_operator_id' => $this->health_operator_id,
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
            'temperature' => $this->temperature?->value,
            'temperature_label' => $this->temperature?->label(),
            'traking' => $this->traking,
            'source' => $this->source,
            'isAutomation' => $this->isAutomation,
            'lifes' => $this->lifes,
            'acceptContestation' => $this->acceptContestation,
            'description' => $this->description,
            'startPrice' => $this->startPrice ? (float) $this->startPrice : null,
            'currentPrice' => $this->currentPrice ? (float) $this->currentPrice : null,
            'negotiatedPrice' => $this->negotiatedPrice ? (float) $this->negotiatedPrice : null,
            'pricingType' => $this->pricingType?->value,
            'pricingType_label' => $this->pricingType?->label(),
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
                        'name' => $this->responsible->user->name,
                        'email' => $this->responsible->user->email,
                        'ucode' => $this->responsible->user->ucode,
                        'phone' => $this->responsible->user->phone,
                    ],
                ];
            }),
            'healthOperator' => $this->whenLoaded('healthOperator', function () {
                return [
                    'id' => $this->healthOperator->id,
                    'name' => $this->healthOperator->name,
                ];
            }),
            'automation' => $this->whenLoaded('automation', function () {
                return [
                    'id' => $this->automation->id,
                    'renewal_date' => $this->automation->renewal_date?->format('Y-m-d H:i:s'),
                    'assist_status' => $this->automation->assist_status,
                ];
            }),
        ];
    }
}
