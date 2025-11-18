<?php

namespace App\DTOs;

class PaymentLinkDTO
{
    public function __construct(
        public readonly string $amount,
        public readonly string $description,
        public readonly string $customerName,
        public readonly string $customerEmail,
        public readonly string $customerPhone,
        public readonly string $expirationDate,
        public readonly array $items,
        public readonly string $callbackUrl,
        public readonly string $returnUrl,
        public readonly string $externalCode
    ) {}

    public function toArray(): array
    {
        // Formatar telefone (apenas números com código do país)
        $formattedPhone = preg_replace('/[^0-9]/', '', $this->customerPhone);
        if (!str_starts_with($formattedPhone, '55')) {
            $formattedPhone = '55' . $formattedPhone;
        }

        return [
            'amount' => $this->amount,
            'description' => $this->description,
            'customer' => [
                'name' => $this->customerName,
                'email' => $this->customerEmail,
                'phone' => $formattedPhone,
            ],
            'expiration_date' => $this->expirationDate,
            'items' => $this->items,
            'callback_url' => $this->callbackUrl,
            'return_url' => $this->returnUrl,
            'external_code' => $this->externalCode,
        ];
    }
}
