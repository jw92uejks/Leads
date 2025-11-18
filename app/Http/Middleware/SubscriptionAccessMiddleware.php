<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;

class SubscriptionAccessMiddleware
{
    public function handle(Request $request, Closure $next, string $feature)
    {
        $user = auth()->user();

        if (!$user->hasActiveSubscription()) {
            return redirect()->route('subscriptions.index')
                ->with('error', 'Você precisa de uma assinatura ativa para acessar esta funcionalidade.');
        }

        $subscription = $user->broker?->subscription;

        if (!$subscription || !$this->hasFeatureAccess($subscription, $feature)) {
            return redirect()->route('subscriptions.index')
                ->with('error', 'Seu plano atual não inclui esta funcionalidade.');
        }

        return $next($request);
    }

    private function hasFeatureAccess(Subscription $subscription, string $feature): bool
    {
        return match($feature) {
            'team_panel' => $subscription->has_team_access,
            'enterprise_panel' => $subscription->has_enterprise_access,
            default => true,
        };
    }
}
