<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role_id'  => 9,
                'ucode'    => 'aB3cD4eF5gH6iJ7kL8mN9oP',
                'name'     => 'Rafael Barros',
                'email'    => 'rafa@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '34992900099',
                'type'     => 1,
                'cpf'      => '12345678901',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 9,
                'ucode'    => 'x2Y9z8W1v6U3t4S7r5Q6p9O',
                'name'     => 'Filipe Oliveira',
                'email'    => 'lipe@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '84998766197',
                'type'     => 1,
                'cpf'      => '98765432109',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 8,
                'ucode'    => 'm5N4b3V2c1X9z8A7y6K4j3H',
                'name'     => 'Felipe Ondeal',
                'email'    => 'felipe@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11998766198',
                'type'     => 2,
                'cpf'      => null,
                'cnpj'     => '12345678000190',
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'Ggt4BVw4CRNrbosC1e19tEa',
                'name'     => 'Gustavo Neri',
                'email'    => 'guga@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '12994362191',
                'type'     => 1,
                'cpf'      => '05576543210',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'gc65T1YEW8zy56AxyGzlfQA',
                'name'     => 'Gabriel Campos',
                'email'    => 'gabi@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11996722397',
                'type'     => 1,
                'cpf'      => '05375529270',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'q7R4s2T8u1V5w3X9y6Z2a4B',
                'name'     => 'Gabriel Annibal',
                'email'    => 'biel@admin.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11998760044',
                'type'     => 1,
                'cpf'      => '11122233344',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'c6D9e2F5g8H1i4J7k0L3m6N',
                'name'     => 'Carlos Mendes',
                'email'    => 'carlos@corretor.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11999991111',
                'type'     => 1,
                'cpf'      => '44455566677',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'o9P2q5R8s1T4u7V0w3X6y9Z',
                'name'     => 'Ana Oliveira',
                'email'    => 'ana@corretor.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11999992222',
                'type'     => 1,
                'cpf'      => '77788899900',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 6,
                'ucode'    => 'a1B4c7D0e3F6g9H2i5J8k1L',
                'name'     => 'João Silva - Tech Solutions',
                'email'    => 'joao@techsolutions.com',
                'password' => bcrypt('123456789'),
                'phone'    => '1134567890',
                'type'     => 2,
                'cpf'      => null,
                'cnpj'     => '23456789000101',
            ],
            [
                'role_id'  => 6,
                'ucode'    => 'm4N7b0V3c6X9z2A5y8K1j4H',
                'name'     => 'Maria Santos - Digital Marketing',
                'email'    => 'maria@digitalmarketing.com',
                'password' => bcrypt('123456789'),
                'phone'    => '2198765432',
                'type'     => 2,
                'cpf'      => null,
                'cnpj'     => '34567890000112',
            ],
            [
                'role_id'  => 6,
                'ucode'    => 'q7R0s3T6u9V2w5X8y1Z4a7B',
                'name'     => 'Pedro Costa - Lead Generation',
                'email'    => 'pedro@leadgeneration.com',
                'password' => bcrypt('123456789'),
                'phone'    => '3133334444',
                'type'     => 2,
                'cpf'      => null,
                'cnpj'     => '45678901000123',
            ],
            [
                'role_id'  => 2,
                'ucode'    => '6p17RE0A17ROay6ON5roJ',
                'name'     => 'Guilherme Moreira',
                'email'    => 'guilherme@exemplo.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11999990001',
                'type'     => 1,
                'cpf'      => '12312312312',
                'cnpj'     => null,
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'Y3GD8Lcfaoz2KfL5WKbo7',
                'name'     => 'Bruno Santos',
                'email'    => 'bruno@exemplo.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11999990002',
                'type'     => 3,
                'cpf'      => '45645645645',
                'cnpj'     => '56789012000134',
            ],
            [
                'role_id'  => 2,
                'ucode'    => 'd249dEjuSs57WVOA8GgLq',
                'name'     => 'Pedro Costa',
                'email'    => 'pedro@exemplo.com',
                'password' => bcrypt('123456789'),
                'phone'    => '11999990003',
                'type'     => 1,
                'cpf'      => '78978978978',
                'cnpj'     => null,
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
