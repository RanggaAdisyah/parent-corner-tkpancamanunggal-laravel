<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'operator@gmail.com'],
            [
                'name' => 'Admin Operator',
                'password' => bcrypt('password123'),
                'role' => 'operator'
            ]
        );
    }
}
