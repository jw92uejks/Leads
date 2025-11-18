<?php

declare(strict_types=1);

namespace App\Payment\DTOs;

class PaymentRequestDTO
{
    public function __construct(
        public float $amount,
        public string $orderId,
        public string $description,
        public array $customer,
        public string $paymentMethod,
        public int $installments = 1,
        public ?array $card = null,
        public ?array $pix = null,
        public ?array $products = null,
        public ?array $subscription = null,
        public ?string $callbackUrl = null,
        public ?string $redirectUrl = null,
        public ?string $cancelUrl = null,
        public ?string $expireAt = null,
        public ?array $metadata = null,
        public ?string $customerName = null,
        public ?string $customerEmail = null,
        public ?string $customerPhone = null,
        public ?string $customerCpf = null,
        public ?string $customerCnpj = null,
        public ?string $customerDocument = null,
    ) {}

    public function toArray(): array
    {
        $customerData = $this->customer;

        if ($this->customerName) {
            $customerData['name'] = $this->customerName;
        }
        if ($this->customerEmail) {
            $customerData['email'] = $this->customerEmail;
        }
        if ($this->customerPhone) {
            $customerData['phone'] = $this->customerPhone;
        }
        if ($this->customerCpf) {
            $customerData['cpf'] = $this->customerCpf;
        }
        if ($this->customerCnpj) {
            $customerData['cnpj'] = $this->customerCnpj;
        }
        if ($this->customerDocument) {
            $customerData['document'] = $this->customerDocument;
        }

        return array_filter([
            'amount' => $this->amount,
            'external_code' => $this->orderId,
            'description' => $this->description,
            'customer' => $customerData,
            'payment_method' => $this->paymentMethod,
            'installments' => $this->installments,
            'card' => $this->card,
            'pix' => $this->pix,
            'products' => $this->products,
            'subscription' => $this->subscription,
            'callback_url' => $this->callbackUrl,
            'redirect_url' => $this->redirectUrl,
            'cancel_url' => $this->cancelUrl,
            'expireAt' => $this->expireAt,
            'metadata' => $this->metadata,
        ], fn($value) => $value !== null);
    }
}
