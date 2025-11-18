<?php

declare(strict_types=1);

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function createPayment(array $paymentData): array;
    public function getPayment(string $paymentId): array;
    public function cancelPayment(string $paymentId): array;
}
