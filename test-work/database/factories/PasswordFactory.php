<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'password' => $this->faker->regexify('[A-Za-z0-9]{8,15}'),
            'access' => $this->faker->randomElement(['to_all', 'only_me']),
            'user_id' => $this->faker->numberBetween(1, 5),
            'group_id' => $this->faker->optional()->numberBetween(1, 3)
        ];
    }
}
