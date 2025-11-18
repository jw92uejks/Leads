<?php

namespace App\DTOs;

use App\Enums\Lead\LeadType;
use App\Models\Lead;

class LeadDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly ?string $name,
        public readonly ?string $corporateName,
        public readonly ?string $phone,
        public readonly ?string $email,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?LeadType $type,
        public readonly ?string $temperature,
        public readonly ?string $traking,
        public readonly ?string $source,
        public readonly float $currentPrice,
        public readonly ?string $ddd,
        public readonly ?string $operadora,
        public readonly string $createdAt,
        public readonly string $typeLabel,
    ) {}

    public static function fromModel(Lead $lead): self
    {
        $ddd = null;
        if ($lead->phone) {
            $ddd = substr(preg_replace('/[^0-9]/', '', $lead->phone), 0, 2);
        }

        $operadora = $lead->healthOperator ? $lead->healthOperator->name : ($lead->source ?? 'N/A');

        $typeLabel = $lead->type ? $lead->type->label() : 'Lead Misto';

        return new self(
            id: $lead->id,
            code: $lead->code ?? '',
            name: $lead->name,
            corporateName: $lead->corporateName,
            phone: $lead->phone,
            email: $lead->email,
            city: $lead->city,
            state: $lead->state,
            type: $lead->type,
            temperature: $lead->temperature,
            traking: $lead->traking,
            source: $lead->source,
            currentPrice: (float) $lead->currentPrice,
            ddd: $ddd,
            operadora: $operadora,
            createdAt: $lead->created_at ? $lead->created_at->format('d/m/y H:i') : 'N/A',
            typeLabel: $typeLabel,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'corporateName' => $this->corporateName,
            'phone' => $this->phone,
            'email' => $this->email,
            'city' => $this->city,
            'state' => $this->state,
            'type' => $this->type?->value,
            'temperature' => $this->temperature,
            'traking' => $this->traking,
            'source' => $this->source,
            'currentPrice' => $this->currentPrice,
            'ddd' => $this->ddd,
            'operadora' => $this->operadora,
            'createdAt' => $this->createdAt,
            'typeLabel' => $this->typeLabel,
        ];
    }
}