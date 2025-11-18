<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Log;

class StripeSubscriptionService
{
    public function createSubscription(User $user, Subscription $subscription): array
    {
        try {
            if (!$subscription->stripe_price_id) {
                throw new \Exception('Plano não possui price_id do Stripe configurado');
            }

            // Criar assinatura usando Laravel Cashier
            $stripeSubscription = $user->newSubscription('default', $subscription->stripe_price_id)
                ->create();

            // Atualizar o broker com a assinatura
            if ($user->broker) {
                $user->broker->update([
                    'subscription_id' => $subscription->id,
                    'subscription_expires_at' => now()->addDays($subscription->durationDays),
                ]);
            }

            return [
                'success' => true,
                'subscription_id' => $stripeSubscription->id,
                'status' => $stripeSubscription->status,
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
                'subscription_id' => $subscription->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function cancelSubscription(User $user): array
    {
        try {
            $subscription = $user->subscription('default');

            if (!$subscription) {
                throw new \Exception('Usuário não possui assinatura ativa');
            }

            $subscription->cancel();

            // Atualizar o broker
            if ($user->broker) {
                $user->broker->update([
                    'subscription_id' => null,
                    'subscription_expires_at' => null,
                ]);
            }

            return [
                'success' => true,
                'message' => 'Assinatura cancelada com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao cancelar assinatura', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function pauseSubscription(User $user): array
    {
        try {
            $subscription = $user->subscription('default');

            if (!$subscription) {
                throw new \Exception('Usuário não possui assinatura ativa');
            }

            $subscription->pause();

            return [
                'success' => true,
                'message' => 'Assinatura pausada com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao pausar assinatura', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function resumeSubscription(User $user): array
    {
        try {
            $subscription = $user->subscription('default');

            if (!$subscription) {
                throw new \Exception('Usuário não possui assinatura pausada');
            }

            $subscription->resume();

            return [
                'success' => true,
                'message' => 'Assinatura reativada com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao reativar assinatura', [
                'user_id' => $user->id,
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

            // Criar sessão de checkout
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

    public function getSubscriptionStatus(User $user): array
    {
        try {
            $subscription = $user->subscription('default');

            if (!$subscription) {
                return [
                    'has_subscription' => false,
                    'status' => null,
                ];
            }

            return [
                'has_subscription' => true,
                'status' => $subscription->status,
                'ends_at' => $subscription->ends_at,
                'canceled_at' => $subscription->canceled_at,
                'trial_ends_at' => $subscription->trial_ends_at,
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao consultar status da assinatura', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return [
                'has_subscription' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
