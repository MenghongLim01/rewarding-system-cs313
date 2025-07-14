<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a single admin
        Admin::create([
            'admin_name' => 'Super Admin',
            'admin_email' => 'admin@example.com',
            'admin_pw' => Hash::make('12345678'),
            // 'admin_profile_image' =>'avatar1.jpg',
        ]);
    }
}
