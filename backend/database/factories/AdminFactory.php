<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    public function definition(): array
    {
        return [
            'admin_email' => $this->faker->unique()->safeEmail,
            'admin_pw' => bcrypt('password123'),
            'created_at' => now(),
        ];
    }
}
