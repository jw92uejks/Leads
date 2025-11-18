<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Broker;

class StripeWebhookController extends Controller
{
    /**
     * Handle customer subscription created.
     */
    protected function handleCustomerSubscriptionCreated($payload)
    {
        Log::info('Stripe webhook: customer.subscription.created', [
            'subscription_id' => $payload['id'],
            'customer_id' => $payload['customer'],
        ]);

        $customerId = $payload['customer'];
        $subscriptionId = $payload['id'];

        $user = User::where('stripe_id', $customerId)->first();

        if ($user && $user->broker) {
            $user->broker->update([
                'is_active' => true,
                'subscription_expires_at' => now()->addMonth(),
            ]);

            Log::info('Assinatura criada - broker atualizado', [
                'user_id' => $user->id,
                'broker_id' => $user->broker->id,
                'subscription_id' => $subscriptionId,
            ]);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle customer subscription updated.
     */
    protected function handleCustomerSubscriptionUpdated($payload)
    {
        Log::info('Stripe webhook: customer.subscription.updated', [
            'subscription_id' => $payload['id'],
            'customer_id' => $payload['customer'],
            'status' => $payload['status'],
        ]);

        $customerId = $payload['customer'];
        $status = $payload['status'];

        $user = User::where('stripe_id', $customerId)->first();

        if ($user && $user->broker) {
            $isActive = in_array($status, ['active', 'trialing']);

            $user->broker->update([
                'is_active' => $isActive,
            ]);

            Log::info('Assinatura atualizada - status atualizado', [
                'user_id' => $user->id,
                'broker_id' => $user->broker->id,
                'status' => $status,
                'is_active' => $isActive,
            ]);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle customer subscription deleted.
     */
    protected function handleCustomerSubscriptionDeleted($payload)
    {
        Log::info('Stripe webhook: customer.subscription.deleted', [
            'subscription_id' => $payload['id'],
            'customer_id' => $payload['customer'],
        ]);

        $customerId = $payload['customer'];

        $user = User::where('stripe_id', $customerId)->first();

        if ($user && $user->broker) {
            $user->broker->update([
                'subscription_id' => null,
                'plan_type' => \App\Enums\PlanType::BASIC->value,
                'is_active' => false,
                'subscription_expires_at' => null,
            ]);

            Log::info('Assinatura cancelada - broker atualizado', [
                'user_id' => $user->id,
                'broker_id' => $user->broker->id,
            ]);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle invoice payment succeeded.
     */
    protected function handleInvoicePaymentSucceeded($payload)
    {
        Log::info('Stripe webhook: invoice.payment_succeeded', [
            'invoice_id' => $payload['id'],
            'customer_id' => $payload['customer'],
            'subscription_id' => $payload['subscription'],
        ]);

        $customerId = $payload['customer'];
        $subscriptionId = $payload['subscription'];

        $user = User::where('stripe_id', $customerId)->first();

        if ($user && $user->broker) {
            $user->broker->update([
                'is_active' => true,
                'subscription_expires_at' => now()->addMonth(),
            ]);

            Log::info('Pagamento aprovado - assinatura renovada', [
                'user_id' => $user->id,
                'broker_id' => $user->broker->id,
                'subscription_id' => $subscriptionId,
            ]);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle invoice payment failed.
     */
    protected function handleInvoicePaymentFailed($payload)
    {
        Log::info('Stripe webhook: invoice.payment_failed', [
            'invoice_id' => $payload['id'],
            'customer_id' => $payload['customer'],
            'subscription_id' => $payload['subscription'],
        ]);

        $customerId = $payload['customer'];

        $user = User::where('stripe_id', $customerId)->first();

        if ($user && $user->broker) {
            $user->broker->update([
                'is_active' => false,
            ]);

            Log::info('Pagamento falhou - status atualizado', [
                'user_id' => $user->id,
                'broker_id' => $user->broker->id,
            ]);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Handle payment intent succeeded.
     */
    protected function handlePaymentIntentSucceeded($payload)
    {
        Log::info('Stripe webhook: payment_intent.succeeded', [
            'payment_intent_id' => $payload['id'],
            'customer_id' => $payload['customer'],
            'amount' => $payload['amount'],
        ]);

        // Aqui você pode implementar lógica específica para pagamentos únicos
        // Por exemplo, liberar créditos, ativar funcionalidades, etc.

        return response('Webhook handled', 200);
    }

    /**
     * Handle payment intent payment failed.
     */
    protected function handlePaymentIntentPaymentFailed($payload)
    {
        Log::info('Stripe webhook: payment_intent.payment_failed', [
            'payment_intent_id' => $payload['id'],
            'customer_id' => $payload['customer'],
            'amount' => $payload['amount'],
        ]);

        // Aqui você pode implementar lógica para falhas de pagamento
        // Por exemplo, notificar o usuário, tentar novamente, etc.

        return response('Webhook handled', 200);
    }

    /**
     * Handle customer updated.
     */
    protected function handleCustomerUpdated($payload)
    {
        Log::info('Stripe webhook: customer.updated', [
            'customer_id' => $payload['id'],
            'email' => $payload['email'],
        ]);

        $customerId = $payload['id'];

        // Buscar usuário pelo stripe_id
        $user = User::where('stripe_id', $customerId)->first();

        if ($user) {
            // Atualizar dados do usuário se necessário
            $user->update([
                'email' => $payload['email'],
                'name' => $payload['name'] ?? $user->name,
            ]);

            Log::info('Cliente atualizado - dados do usuário sincronizados', [
                'user_id' => $user->id,
                'email' => $payload['email'],
            ]);
        }

        return response('Webhook handled', 200);
    }
}
