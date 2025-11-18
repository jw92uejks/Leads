<?php

declare(strict_types=1);

namespace App\Payment\Gateways;

use App\Payment\Contracts\PaymentGatewayContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StripeGateway implements PaymentGatewayContract
{
    private string $secretKey;
    private string $publicKey;
    private string $webhookSecret;

    public function __construct()
    {
        $config = config('payments.gateways.stripe.config', []);
        $this->secretKey = $config['secret_key'] ?? '';
        $this->publicKey = $config['public_key'] ?? '';
        $this->webhookSecret = $config['webhook_secret'] ?? '';
    }

    public function createPayment(array $data): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->post('https://api.stripe.com/v1/payment_intents', [
                'amount' => (int) ($data['amount'] * 100),
                'currency' => 'brl',
                'payment_method_types' => ['card'],
                'metadata' => [
                    'order_id' => $data['order_id'],
                    'customer_name' => $data['customer']['name'] ?? '',
                    'customer_email' => $data['customer']['email'] ?? '',
                ],
            ]);

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['id'] ?? null,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => $responseData['status'] ?? 'unknown',
                'payment_url' => null,
                'qr_code' => null,
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - createPayment', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function createLinkPayment(array $data): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->post('https://api.stripe.com/v1/payment_links', [
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'brl',
                            'product_data' => [
                                'name' => $data['description'],
                            ],
                            'unit_amount' => (int) ($data['amount'] * 100),
                        ],
                        'quantity' => 1,
                    ],
                ],
                'metadata' => [
                    'order_id' => $data['order_id'],
                ],
            ]);

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['id'] ?? null,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => 'pending',
                'payment_url' => $responseData['url'] ?? null,
                'qr_code' => null,
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - createLinkPayment', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function getPayment(string $paymentId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->get("https://api.stripe.com/v1/payment_intents/{$paymentId}");

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['id'] ?? $paymentId,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => $responseData['status'] ?? 'unknown',
                'payment_url' => null,
                'qr_code' => null,
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - getPayment', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function cancelPayment(string $paymentId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->post("https://api.stripe.com/v1/payment_intents/{$paymentId}/cancel");

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['id'] ?? $paymentId,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => 'cancelled',
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - cancelPayment', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function capturePayment(string $paymentId): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->post("https://api.stripe.com/v1/payment_intents/{$paymentId}/capture");

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['id'] ?? $paymentId,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => $responseData['status'] ?? 'unknown',
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - capturePayment', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function refundPayment(string $paymentId, ?float $amount = null): array
    {
        try {
            $data = ['payment_intent' => $paymentId];
            if ($amount !== null) {
                $data['amount'] = (int) ($amount * 100);
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->post('https://api.stripe.com/v1/refunds', $data);

            $responseData = $response->json();

            return [
                'payment_id' => $responseData['payment_intent'] ?? $paymentId,
                'transaction_id' => $responseData['id'] ?? null,
                'status' => 'refunded',
                'metadata' => $responseData,
            ];
        } catch (\Exception $e) {
            Log::error('Erro no gateway Stripe - refundPayment', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId,
                'amount' => $amount,
            ]);

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }

    public function getGatewayName(): string
    {
        return 'stripe';
    }

    public function isConfigured(): bool
    {
        return !empty($this->secretKey) && !empty($this->publicKey);
    }
}
