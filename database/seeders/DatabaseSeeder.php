<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🔐 Buat admin (WAJIB PERTAMA)
        $this->call(AdminSeeder::class);

        // (Opsional) user dummy untuk testing
        // User::factory(10)->create();
    }
}
