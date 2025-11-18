<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = \App\Models\Team::first();
        $brokers = \App\Models\Broker::all();

        if (!$team || $brokers->isEmpty()) {
            $this->command->warn('Nenhum team ou broker encontrado. Pulando TeamMemberSeeder.');
            return;
        }

        // Adicionar todos os brokers como membros do time
        foreach ($brokers as $broker) {
            DB::table('team_members')->insert([
                [
                    'team_id' => $team->id,
                    'broker_id' => $broker->id,
                    'role_in_team' => $broker->id === $team->owner_id ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}