<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Seed teams for testing and demonstration purposes.
     * Creates sample teams with different brokers as owners.
     */
    public function run(): void
    {
        $brokers = \App\Models\Broker::all();

        if ($brokers->isEmpty()) {
            $this->command->warn('Nenhum broker encontrado. Pulando TeamSeeder.');
            return;
        }

        $teams = [
            [
                'owner_id' => $brokers->first()->id,
                'team_name' => 'Equipe Principal',
                'description' => 'Equipe principal de vendas e atendimento',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => $brokers->count() > 1 ? $brokers->skip(1)->first()->id : $brokers->first()->id,
                'team_name' => 'Equipe Secundária',
                'description' => 'Equipe secundária para suporte e backup',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'owner_id' => $brokers->count() > 2 ? $brokers->skip(2)->first()->id : $brokers->first()->id,
                'team_name' => 'Equipe de Novos Negócios',
                'description' => 'Equipe focada em captação de novos clientes',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($teams as $team) {
            DB::table('teams')->insert($team);
        }

        $this->command->info('Teams criados com sucesso!');
    }
}