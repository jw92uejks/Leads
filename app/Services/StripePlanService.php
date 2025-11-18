<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripePlanService
{
    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    public function syncPlansWithStripe(): array
    {
        $results = ['created' => 0, 'updated' => 0, 'deactivated' => 0, 'errors' => 0];

        try {
            // Buscar produtos do Stripe
            $products = $this->stripe->products->all(['active' => true]);

            $stripeProductIds = [];

            foreach ($products->data as $product) {
                try {
                    $stripeProductIds[] = $product->id;

                    // Buscar preços do produto
                    $prices = $this->stripe->prices->all([
                        'product' => $product->id,
                        'active' => true
                    ]);

                    foreach ($prices->data as $price) {
                        // Buscar plano local ou criar
                        $localPlan = Subscription::where('stripe_product_id', $product->id)
                            ->where('stripe_price_id', $price->id)
                            ->first();

                        $planData = [
                            'name' => $product->name,
                            'description' => $product->description ?? '',
                            'price' => $price->unit_amount / 100, // Stripe usa centavos
                            'durationDays' => $this->getDurationDays($price),
                            'plan_type' => $this->mapPlanType($product->name),
                            'features' => $this->extractFeatures($product),
                            'max_team_members' => $this->getMaxTeamMembers($product),
                            'has_team_access' => $this->hasTeamAccess($product),
                            'has_enterprise_access' => $this->hasEnterpriseAccess($product),
                            'isActive' => $product->active,
                            'stripe_product_id' => $product->id,
                            'stripe_price_id' => $price->id,
                            'last_synced_at' => now()
                        ];

                        if ($localPlan) {
                            $localPlan->update($planData);
                            $results['updated']++;
                        } else {
                            Subscription::create($planData);
                            $results['created']++;
                        }
                    }

                } catch (\Exception $e) {
                    $results['errors']++;
                    Log::error("Error syncing plan from Stripe", [
                        'product_id' => $product->id ?? 'unknown',
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Desativar planos que não existem mais no Stripe
            $deactivated = Subscription::whereNotIn('stripe_product_id', $stripeProductIds)
                ->whereNotNull('stripe_product_id')
                ->update(['isActive' => false]);

            $results['deactivated'] = $deactivated;

        } catch (\Exception $e) {
            $results['errors']++;
            Log::error("Error fetching plans from Stripe", ['error' => $e->getMessage()]);
        }

        return $results;
    }

    public function createPlanInStripe(Subscription $plan): array
    {
        try {
            // Criar produto no Stripe
            $product = $this->stripe->products->create([
                'name' => $plan->name,
                'description' => $plan->description,
                'metadata' => [
                    'plan_type' => $plan->plan_type,
                    'max_team_members' => $plan->max_team_members ?? 1,
                    'has_team_access' => $plan->has_team_access ? 'true' : 'false',
                    'has_enterprise_access' => $plan->has_enterprise_access ? 'true' : 'false',
                ]
            ]);

            // Criar preço no Stripe
            $price = $this->stripe->prices->create([
                'product' => $product->id,
                'unit_amount' => (int) ($plan->price * 100), // Converter para centavos
                'currency' => 'brl',
                'recurring' => [
                    'interval' => 'month',
                    'interval_count' => 1,
                ],
                'metadata' => [
                    'duration_days' => $plan->durationDays ?? 30,
                ]
            ]);

            // Atualizar plano local com IDs do Stripe
            $plan->update([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
                'last_synced_at' => now()
            ]);

            return [
                'success' => true,
                'product_id' => $product->id,
                'price_id' => $price->id,
                'message' => 'Plano criado no Stripe com sucesso'
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao criar plano no Stripe', [
                'plan_id' => $plan->id,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function getDurationDays($price): int
    {
        if ($price->recurring) {
            $interval = $price->recurring->interval;
            $count = $price->recurring->interval_count ?? 1;

            return match($interval) {
                'day' => $count,
                'week' => $count * 7,
                'month' => $count * 30,
                'year' => $count * 365,
                default => 30,
            };
        }

        return 30; // Default
    }

    private function mapPlanType(string $name): string
    {
        $name = strtolower($name);

        if (str_contains($name, 'individual') || str_contains($name, 'basic')) {
            return 'individual';
        }

        if (str_contains($name, 'team') || str_contains($name, 'equipe')) {
            return 'teams';
        }

        if (str_contains($name, 'enterprise') || str_contains($name, 'empresarial')) {
            return 'enterprise';
        }

        return 'individual';
    }

    private function extractFeatures($product): array
    {
        $planType = $this->mapPlanType($product->name);

        return match($planType) {
            'individual' => ['contacts', 'leads'],
            'teams' => ['contacts', 'leads', 'team_panel'],
            'enterprise' => ['contacts', 'leads', 'team_panel', 'enterprise_panel'],
            default => ['contacts', 'leads'],
        };
    }

    private function getMaxTeamMembers($product): int
    {
        $metadata = $product->metadata ?? [];
        return (int) ($metadata['max_team_members'] ?? 1);
    }

    private function hasTeamAccess($product): bool
    {
        $metadata = $product->metadata ?? [];
        return ($metadata['has_team_access'] ?? 'false') === 'true';
    }

    private function hasEnterpriseAccess($product): bool
    {
        $metadata = $product->metadata ?? [];
        return ($metadata['has_enterprise_access'] ?? 'false') === 'true';
    }
}
