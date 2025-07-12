<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a single admin
        Admin::create([
            'admin_email' => 'admin@example.com',
            'admin_pw' => bcrypt('12345678'),
        ]);
    }
}
