<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "mohammed",
            'email' => "mohammed@gmail.com",
            'password' => Hash::make('123456')

            // لتنفيذه نكتب بالكوماند هاد الامر
            //php artisan db:seed --class=AdminSeeder

        ];
    }
}