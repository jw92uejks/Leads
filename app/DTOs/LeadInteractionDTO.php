<?php

declare(strict_types=1);

namespace App\DTOs;

class LeadInteractionDTO
{
    public function __construct(
        public readonly int $fromStep,
        public readonly int $toStep,
        public readonly ?string $description = null,
        public readonly ?float $negotiatedPrice = null,
        public readonly ?string $returnDate = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fromStep: (int) $data['from_step'],
            toStep: (int) $data['to_step'],
            description: $data['description'] ?? null,
            negotiatedPrice: isset($data['negotiatedPrice']) ? (float) $data['negotiatedPrice'] : null,
            returnDate: $data['return_date'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'from_step' => $this->fromStep,
            'to_step' => $this->toStep,
            'description' => $this->description,
            'negotiatedPrice' => $this->negotiatedPrice,
            'return_date' => $this->returnDate,
        ];
    }
}