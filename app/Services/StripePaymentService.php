<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Subscription;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripePaymentService
{
    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    public function createSubscription(User $user, string $priceId): array
    {
        try {
            $subscription = $user->newSubscription('default', $priceId)
                ->create();

            return [
                'success' => true,
                'subscription_id' => $subscription->id,
                'status' => $subscription->status,
                'message' => 'Assinatura criada com sucesso'
            ];

        } catch (IncompletePayment $e) {
            return [
                'success' => false,
                'error' => 'Pagamento incompleto',
                'payment_intent' => $e->payment->asStripePaymentIntent(),
            ];
        } catch (\Exception $e) {
            Log::error('Erro ao criar assinatura', [
                'user_id' => $user->id,
                'price_id' => $priceId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createPaymentIntent(User $user, float $amount, array $metadata = []): array
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => (int) ($amount * 100), // Converter para centavos
                'currency' => 'brl',
                'customer' => $user->stripe_id,
                'metadata' => $metadata,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return [
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $amount,
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao criar Payment Intent', [
                'user_id' => $user->id,
                'amount' => $amount,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createCheckoutSession(User $user, Subscription $subscription): array
    {
        try {
            if (!$subscription->stripe_price_id) {
                throw new \Exception('Plano não possui price_id do Stripe configurado');
            }

            $checkoutSession = $user->checkout([
                'price' => $subscription->stripe_price_id,
                'success_url' => route('subscriptions.success'),
                'cancel_url' => route('pricing.index'),
                'metadata' => [
                    'subscription_id' => $subscription->id,
                    'user_id' => $user->id,
                ],
            ]);

            return [
                'success' => true,
                'checkout_url' => $checkoutSession->url,
                'session_id' => $checkoutSession->id,
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao criar sessão de checkout', [
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function createCustomerPortalSession(User $user): array
    {
        try {
            $session = $user->createSetupIntent();

            return [
                'success' => true,
                'setup_intent' => $session,
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao criar sessão do portal do cliente', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getPaymentMethods(User $user): array
    {
        try {
            $paymentMethods = $user->paymentMethods();

            return [
                'success' => true,
                'payment_methods' => $paymentMethods,
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao buscar métodos de pagamento', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function addPaymentMethod(User $user, string $paymentMethodId): array
    {
        try {
            $user->addPaymentMethod($paymentMethodId);

            return [
                'success' => true,
                'message' => 'Método de pagamento adicionado com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao adicionar método de pagamento', [
                'user_id' => $user->id,
                'payment_method_id' => $paymentMethodId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function removePaymentMethod(User $user, string $paymentMethodId): array
    {
        try {
            $user->removePaymentMethod($paymentMethodId);

            return [
                'success' => true,
                'message' => 'Método de pagamento removido com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao remover método de pagamento', [
                'user_id' => $user->id,
                'payment_method_id' => $paymentMethodId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function updateDefaultPaymentMethod(User $user, string $paymentMethodId): array
    {
        try {
            $user->updateDefaultPaymentMethod($paymentMethodId);

            return [
                'success' => true,
                'message' => 'Método de pagamento padrão atualizado com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar método de pagamento padrão', [
                'user_id' => $user->id,
                'payment_method_id' => $paymentMethodId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
