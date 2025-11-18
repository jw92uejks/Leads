<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $leads = Lead::all();

        if ($leads->isEmpty()) {
            $this->command->warn('Nenhum lead encontrado. Execute primeiro o LeadSeeder.');
            return;
        }

        $this->command->info('Criando participantes para os leads...');

        foreach ($leads as $lead) {
            $participantsCount = rand(1, 4);

            Participant::factory($participantsCount)->forLead($lead->id)->create();
        }

        $totalParticipants = Participant::count();
        $this->command->info("Criados {$totalParticipants} participantes para {$leads->count()} leads.");
    }
}
