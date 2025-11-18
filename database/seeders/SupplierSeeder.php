<?php

namespace Database\Seeders;

use App\Enums\SupplierStatus;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Seed fornecedores base do sistema.
     *
     * Cria fornecedores padrão para testes e demonstração.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'user_id' => 7,
                'name' => 'Ondeal',
                'cnpj' => '33.444.555/0001-99',
                'classification' => 'A',
                'phone' => '11930009201',
                'city' => 'Campinas',
                'state' => 'SP',
                'stateRegistration' => '00000',
                'rating' => 5.0,
                'lgpdTerm' => true,
                'status' => SupplierStatus::APPROVED,
                'approval_date_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'name' => 'Doutor Leads',
                'cnpj' => '43.586.121/0001-80',
                'classification' => 'B',
                'phone' => '11958711041',
                'city' => 'São Paulo',
                'state' => 'SP',
                'stateRegistration' => '00000',
                'rating' => 3.2,
                'lgpdTerm' => true,
                'status' => SupplierStatus::APPROVED,
                'approval_date_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'name' => 'Salyd',
                'cnpj' => '34.253.016/0001-63',
                'classification' => 'A',
                'phone' => '1151991032',
                'city' => 'São Paulo',
                'state' => 'SP',
                'stateRegistration' => '00000',
                'rating' => 4.6,
                'lgpdTerm' => true,
                'status' => SupplierStatus::APPROVED,
                'approval_date_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
