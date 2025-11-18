<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\StripeSubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(
        private readonly StripeSubscriptionService $subscriptionService
    ) {}

    public function index()
    {
        $subscriptions = Subscription::where('isActive', true)->get();
        return view('pclient.subscriptions.index', compact('subscriptions'));
    }

    public function createPaymentLink(Request $request)
    {
        try {
            $request->validate([
                'subscription_id' => 'required|exists:subscriptions,id',
            ]);

            $user = auth()->user();
            $subscription = Subscription::findOrFail($request->subscription_id);

            $result = $this->subscriptionService->createCheckoutSession($user, $subscription);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'checkout_url' => $result['checkout_url'],
                    'message' => 'Sessão de checkout criada com sucesso!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['error']
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Erro ao criar sessão de checkout', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar sessão de checkout: ' . $e->getMessage()
            ], 500);
        }
    }

    public function success()
    {
        return view('pclient.subscriptions.success');
    }
}
