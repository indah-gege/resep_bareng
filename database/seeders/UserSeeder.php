<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan updateOrCreate supaya tidak error Duplicate Entry
        
        // 1. Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'], // Cari berdasarkan email
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('password'),
                'role'     => 'superadmin',
            ]
        );

        // 2. Admin Pertama
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin Utama',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // 3. Admin Kedua (Yang tadi belum masuk)
        User::updateOrCreate(
            ['email' => 'admin2@gmail.com'],
            [
                'name'     => 'Admin Dua',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // 4. User Biasa
        User::updateOrCreate(
            ['email' => 'siti@gmail.com'],
            [
                'name'     => 'Siti Nurul',
                'password' => Hash::make('password'),
                'role'     => 'user',
            ]
        );
    }
}