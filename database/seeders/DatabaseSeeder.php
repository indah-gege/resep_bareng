<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hanya memanggil UserSeeder agar data admin/user masuk ke database
        $this->call(UserSeeder::class);
    }
}