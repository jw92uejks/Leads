<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            [
                'name'           => 'Rafael',
                'email'          => 'rafael@admin.com',
                'password'       =>  bcrypt('123456789'),
            ],
            [
                'name'           => 'Carlos',
                'email'          => 'carlos@admin.com',
                'password'       =>  bcrypt('123456789'),
            ],
            [
                'name'           => 'Flavio',
                'email'          => 'flavio@admin.com',
                'password'       =>  bcrypt('123456789'),
            ],
            [
                'name'           => 'Lopes',
                'email'          => 'lopes@admin.com',
                'password'       =>  bcrypt('123456789'),
            ],
        ]);

    }
}