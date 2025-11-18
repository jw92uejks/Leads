<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\StripeSubscriptionService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __construct(
        private readonly StripeSubscriptionService $subscriptionService
    ) {}

    public function index()
    {
        return view('pclient.pricing.index');
    }

    public function selectPlan(Request $request, $subscriptionId)
    {
        try {
            $user = auth()->user();
            $subscription = Subscription::findOrFail($subscriptionId);

            // Verificar se o plano está configurado com Stripe
            if (!$subscription->stripe_price_id) {
                return redirect()->route('pricing.index')
                    ->with('error', 'Plano não está disponível no momento. Tente novamente em alguns instantes.');
            }

            $result = $this->subscriptionService->createCheckoutSession($user, $subscription);

            if ($result['success']) {
                return redirect($result['checkout_url']);
            } else {
                return redirect()->route('pricing.index')
                    ->with('error', $result['error'] ?? 'Erro ao criar sessão de checkout. Tente novamente.');
            }

        } catch (\Exception $e) {
            \Log::error('Erro ao processar seleção de plano', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $errorMessage = 'Ops! Algo deu errado ao processar sua seleção. ';

            if (str_contains($e->getMessage(), 'not found')) {
                $errorMessage .= 'Plano não encontrado. Verifique se o plano ainda está disponível.';
            } elseif (str_contains($e->getMessage(), 'payment')) {
                $errorMessage .= 'Erro no sistema de pagamento. Tente novamente ou entre em contato conosco.';
            } else {
                $errorMessage .= 'Tente novamente ou entre em contato conosco se o problema persistir.';
            }

            return redirect()->route('pricing.index')
                ->with('error', $errorMessage);
        }
    }
}