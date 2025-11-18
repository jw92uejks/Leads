<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Payment\Services\PaymentService;
use App\Payment\DTOs\PaymentRequestDTO;
use App\Payment\DTOs\PaymentResponseDTO;
use App\Models\User;
use Illuminate\Support\Facades\App;

class PaymentHelper
{
    public static function createPayment(
        float $amount,
        string $orderId,
        string $description,
        array $customer,
        string $paymentMethod = 'all',
        ?array $options = null
    ): PaymentResponseDTO {
        $paymentService = App::make(PaymentService::class);

        $request = new PaymentRequestDTO(
            amount: $amount,
            orderId: $orderId,
            description: $description,
            customer: $customer,
            paymentMethod: $paymentMethod,
            installments: $options['installments'] ?? 1,
            card: $options['card'] ?? null,
            pix: $options['pix'] ?? null,
            products: $options['products'] ?? null,
            subscription: $options['subscription'] ?? null,
            callbackUrl: $options['callback_url'] ?? null,
            expireAt: $options['expire_at'] ?? null,
            metadata: $options['metadata'] ?? null,
        );

        return $paymentService->createPayment($request);
    }

    public static function createLinkPayment(
        float $amount,
        string $orderId,
        string $description,
        array $customer,
        string $paymentMethod = 'all',
        ?array $options = null
    ): PaymentResponseDTO {
        $paymentService = App::make(PaymentService::class);

        $request = new PaymentRequestDTO(
            amount: $amount,
            orderId: $orderId,
            description: $description,
            customer: $customer,
            paymentMethod: $paymentMethod,
            installments: $options['installments'] ?? 1,
            card: $options['card'] ?? null,
            pix: $options['pix'] ?? null,
            products: $options['products'] ?? null,
            subscription: $options['subscription'] ?? null,
            callbackUrl: $options['callback_url'] ?? null,
            expireAt: $options['expire_at'] ?? null,
            metadata: $options['metadata'] ?? null,
        );

        return $paymentService->createLinkPayment($request);
    }

    public static function getCurrentGateway(): string
    {
        $paymentService = App::make(PaymentService::class);
        return $paymentService->getCurrentGateway();
    }

    public static function switchGateway(string $gateway): void
    {
        $paymentService = App::make(PaymentService::class);
        $paymentService->switchGateway($gateway);
    }

    public static function createPaymentWithUser(
        User $user,
        float $amount,
        string $orderId,
        string $description,
        string $paymentMethod = 'all',
        ?array $options = null
    ): PaymentResponseDTO {
        $paymentService = App::make(PaymentService::class);

        $paymentData = [
            'amount' => $amount,
            'orderId' => $orderId,
            'description' => $description,
            'paymentMethod' => $paymentMethod,
            'installments' => $options['installments'] ?? 1,
            'card' => $options['card'] ?? null,
            'pix' => $options['pix'] ?? null,
            'products' => $options['products'] ?? null,
            'subscription' => $options['subscription'] ?? null,
            'callbackUrl' => $options['callback_url'] ?? null,
            'expireAt' => $options['expire_at'] ?? null,
            'metadata' => $options['metadata'] ?? null,
        ];

        return $paymentService->createPaymentWithUser($user, $paymentData);
    }

    public static function createLinkPaymentWithUser(
        User $user,
        float $amount,
        string $orderId,
        string $description,
        string $paymentMethod = 'all',
        ?array $options = null
    ): PaymentResponseDTO {
        $paymentService = App::make(PaymentService::class);

        $paymentData = [
            'amount' => $amount,
            'orderId' => $orderId,
            'description' => $description,
            'paymentMethod' => $paymentMethod,
            'installments' => $options['installments'] ?? 1,
            'card' => $options['card'] ?? null,
            'pix' => $options['pix'] ?? null,
            'products' => $options['products'] ?? null,
            'subscription' => $options['subscription'] ?? null,
            'callbackUrl' => $options['callback_url'] ?? null,
            'expireAt' => $options['expire_at'] ?? null,
            'metadata' => $options['metadata'] ?? null,
        ];

        return $paymentService->createLinkPaymentWithUser($user, $paymentData);
    }
}
