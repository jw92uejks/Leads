<?php

namespace Database\Seeders;

use App\Models\HealthOperator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HealthOperatorSeeder extends Seeder
{
    /**
     * Seed operadoras de saúde base do sistema.
     *
     * Cria operadoras padrão para o marketplace de leads.
     */
    public function run(): void
    {
        DB::table('health_operators')->insert([
            ['name' => 'Amil', 'code' => 'amil', 'logo' => 'assets/images/operatorslogos/amil.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Atitude Saúde', 'code' => 'atitudesaude', 'logo' => 'assets/images/operatorslogos/atitudesaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aurora Saúde', 'code' => 'aurorasaude', 'logo' => 'assets/images/operatorslogos/aurorasaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blue', 'code' => 'blue', 'logo' => 'assets/images/operatorslogos/blue.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bradesco Saúde', 'code' => 'bradescosaude', 'logo' => 'assets/images/operatorslogos/bradescosaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CEAM', 'code' => 'ceam', 'logo' => 'assets/images/operatorslogos/ceam.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CEMERU', 'code' => 'cemeru', 'logo' => 'assets/images/operatorslogos/cemeru.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hapvida', 'code' => 'hapvida', 'logo' => 'assets/images/operatorslogos/hapvida.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HBC Saúde', 'code' => 'hbcsaude', 'logo' => 'assets/images/operatorslogos/hbcsaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MedSênior', 'code' => 'medsenior', 'logo' => 'assets/images/operatorslogos/medsenior.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Plenum Saúde', 'code' => 'plenumsaude', 'logo' => 'assets/images/operatorslogos/plenumsaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Porto Saúde', 'code' => 'portosaude', 'logo' => 'assets/images/operatorslogos/portosaude.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sagrada Família', 'code' => 'sagradafamilia', 'logo' => 'assets/images/operatorslogos/sagradafamilia.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SulAmérica', 'code' => 'sulamerica', 'logo' => 'assets/images/operatorslogos/sulamerica.png', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
