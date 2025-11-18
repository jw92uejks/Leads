<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Seed planos de assinatura do Stripe.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Plano Individual',
                'description' => 'Plano para corretores individuais',
                'price' => 29.90,
                'durationDays' => 30,
                'isActive' => true,
                'plan_type' => 'individual',
                'features' => json_encode(['contacts', 'leads']),
                'max_team_members' => 1,
                'has_team_access' => false,
                'has_enterprise_access' => false,
                'stripe_product_id' => 'prod_individual',
                'stripe_price_id' => 'price_individual',
                'last_synced_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plano por Equipe',
                'description' => 'Plano para equipes de corretores',
                'price' => 79.90,
                'durationDays' => 30,
                'isActive' => true,
                'plan_type' => 'teams',
                'features' => json_encode(['contacts', 'leads', 'team_panel']),
                'max_team_members' => 10,
                'has_team_access' => true,
                'has_enterprise_access' => false,
                'stripe_product_id' => 'prod_teams',
                'stripe_price_id' => 'price_teams',
                'last_synced_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plano Empresarial',
                'description' => 'Plano completo para empresas',
                'price' => 199.90,
                'durationDays' => 30,
                'isActive' => true,
                'plan_type' => 'enterprise',
                'features' => json_encode(['contacts', 'leads', 'team_panel', 'enterprise_panel']),
                'max_team_members' => 50,
                'has_team_access' => true,
                'has_enterprise_access' => true,
                'stripe_product_id' => 'prod_enterprise',
                'stripe_price_id' => 'price_enterprise',
                'last_synced_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Subscription::insert($plans);
    }
}
