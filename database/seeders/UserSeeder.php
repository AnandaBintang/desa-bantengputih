<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@desa.test'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'anandabintang4@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('mobil3135oyi'),
                'role' => 'super_admin',
            ]
        );
    }
}
