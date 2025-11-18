<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Seed eventos base do sistema.
     *
     * Cria eventos padrão para testes e demonstração do calendário.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'user_id' => 1,
                'title' => 'Reunião de Planejamento',
                'description' => 'Reunião semanal para planejamento de atividades da secretária',
                'start_date' => Carbon::today()->addDays(1)->setTime(9, 0),
                'end_date' => Carbon::today()->addDays(1)->setTime(10, 30),
                'all_day' => false,
                'color' => '#3788d8',
                'status' => 'scheduled',
                'type' => 'meeting',
                'location' => 'Sala de Reuniões',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Consulta Dr. Silva',
                'description' => 'Consulta médica agendada para paciente João',
                'start_date' => Carbon::today()->addDays(2)->setTime(14, 0),
                'end_date' => Carbon::today()->addDays(2)->setTime(15, 0),
                'all_day' => false,
                'color' => '#50cd89',
                'status' => 'scheduled',
                'type' => 'appointment',
                'location' => 'Consultório 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Lembrete: Renovar Contratos',
                'description' => 'Verificar e renovar contratos que vencem este mês',
                'start_date' => Carbon::today()->addDays(3)->setTime(10, 0),
                'end_date' => null,
                'all_day' => false,
                'color' => '#f1416c',
                'status' => 'scheduled',
                'type' => 'reminder',
                'location' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Conferência de Saúde',
                'description' => 'Participação na conferência anual de saúde',
                'start_date' => Carbon::today()->addDays(7),
                'end_date' => Carbon::today()->addDays(8),
                'all_day' => true,
                'color' => '#7239ea',
                'status' => 'scheduled',
                'type' => 'personal',
                'location' => 'Centro de Convenções',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'Organizar Agenda Semanal',
                'description' => 'Tarefa semanal para organização da agenda',
                'start_date' => Carbon::today()->addDays(5)->setTime(8, 30),
                'end_date' => Carbon::today()->addDays(5)->setTime(9, 30),
                'all_day' => false,
                'color' => '#ff6800',
                'status' => 'scheduled',
                'type' => 'task',
                'location' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}