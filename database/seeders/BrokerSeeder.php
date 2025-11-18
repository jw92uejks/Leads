<?php

namespace Database\Seeders;

use App\Models\Broker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrokerSeeder extends Seeder
{
    /**
     * Seed corretores base do sistema.
     *
     * Cria corretores com diferentes planos ativos para testes.
     */
    public function run(): void
    {
        DB::table('brokers')->insert([
            [
                'user_id' => 1,
                'subscription_id' => 3,
                'plan_type' => \App\Enums\PlanType::ENTERPRISE->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'subscription_id' => 3,
                'plan_type' => \App\Enums\PlanType::ENTERPRISE->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'subscription_id' => 3,
                'plan_type' => \App\Enums\PlanType::ENTERPRISE->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addYear(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'subscription_id' => 1,
                'plan_type' => \App\Enums\PlanType::INDIVIDUAL->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addDays(20),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'subscription_id' => 2,
                'plan_type' => \App\Enums\PlanType::TEAMS->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'subscription_id' => null,
                'plan_type' => \App\Enums\PlanType::BASIC->value,
                'is_active' => false,
                'subscription_expires_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'subscription_id' => null,
                'plan_type' => \App\Enums\PlanType::BASIC->value,
                'is_active' => false,
                'subscription_expires_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'subscription_id' => null,
                'plan_type' => \App\Enums\PlanType::BASIC->value,
                'is_active' => false,
                'subscription_expires_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'subscription_id' => 3,
                'plan_type' => \App\Enums\PlanType::ENTERPRISE->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addDays(90),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'subscription_id' => 2,
                'plan_type' => \App\Enums\PlanType::TEAMS->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'subscription_id' => 1,
                'plan_type' => \App\Enums\PlanType::INDIVIDUAL->value,
                'is_active' => true,
                'subscription_expires_at' => now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}