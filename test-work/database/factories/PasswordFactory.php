<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'password' => Hash::make('12345'),
            'group_id' => null,
            'user_id' => $this->faker->numberBetween(1, 5),
            'access' => $this->faker->randomElement(['to_all', 'only_me']),
        ];
    }
}
