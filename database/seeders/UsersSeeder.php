<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'GHOSTFACE',
                'email' => 'GHOSTFACE@tutu.tu',
                'password' => '$2y$10$3i.sOZPrLtWTBwEeqVu8g.xkX8mtpZza4IH72Cekm6/IFY8F1268S',
                'birthdate' => '2005-07-04',
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'wasss4bi',
                'email' => 'wasss4bi@tutu.tu',
                'password' => '$2y$10$3i.sOZPrLtWTBwEeqVu8g.xkX8mtpZza4IH72Cekm6/IFY8F1268S',
                'birthdate' => '2005-07-04',
                'role' => 'lector',
            ],
            [
                'id' => 3,
                'name' => 'tortik',
                'email' => 'tortik@tutu.tu',
                'password' => '$2y$10$3i.sOZPrLtWTBwEeqVu8g.xkX8mtpZza4IH72Cekm6/IFY8F1268S',
                'birthdate' => '2005-07-04',
                'role' => 'user',
            ],
        ]);
    }
}
