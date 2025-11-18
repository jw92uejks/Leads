<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed da aplicação.
     *
     * Executa todos os seeders na ordem correta para garantir
     * que as dependências sejam criadas antes dos dados que as utilizam.
     */
    public function run(): void
    {
        $this->call([
            SubscriptionSeeder::class,
            UsersTableSeeder::class,
            BrokerSeeder::class,
            TeamSeeder::class,
            TeamMemberSeeder::class,
            SupplierSeeder::class,
            HealthOperatorSeeder::class,
            EventSeeder::class,
            LeadSeeder::class,
            LeadAutomationSeeder::class,
            ContactSeeder::class,
            ParticipantSeeder::class,
        ]);
    }
}
