<?php

declare(strict_types=1);

namespace App\Payment\DTOs;

class PaymentResponseDTO
{
    public function __construct(
        public string $paymentId,
        public string $transactionId,
        public string $status,
        public string $gateway,
        public ?string $paymentUrl = null,
        public ?string $qrCode = null,
        public ?array $metadata = null,
        public ?string $error = null,
    ) {}

    public function isSuccess(): bool
    {
        if ($this->error === null && !empty($this->paymentUrl)) {
            return true;
        }
        return $this->error === null && in_array($this->status, ['approved', 'pending', 'processing']);
    }

    public function getGatewayName(): string
    {
        return $this->gateway;
    }

    public function toArray(): array
    {
        return [
            'payment_id' => $this->paymentId,
            'transaction_id' => $this->transactionId,
            'status' => $this->status,
            'gateway' => $this->gateway,
            'payment_url' => $this->paymentUrl,
            'qr_code' => $this->qrCode,
            'metadata' => $this->metadata,
            'error' => $this->error,
            'success' => $this->isSuccess(),
        ];
    }
}
