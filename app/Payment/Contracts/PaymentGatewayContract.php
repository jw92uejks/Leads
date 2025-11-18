<?php

declare(strict_types=1);

namespace App\Payment\Contracts;

interface PaymentGatewayContract
{
    public function createPayment(array $data): array;
    public function createLinkPayment(array $data): array;
    public function getPayment(string $paymentId): array;
    public function cancelPayment(string $paymentId): array;
    public function capturePayment(string $paymentId): array;
    public function refundPayment(string $paymentId, ?float $amount = null): array;
    public function getGatewayName(): string;
    public function isConfigured(): bool;
}
