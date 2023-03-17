<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'dni' => fake()->unique()->randomNumber(8, true),
            'phone' => fake()->unique()->phoneNumber(),
            'birthdate' => fake()->date(),
            'bibliografy' => fake()->text(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement(['admin', 'client']),
            'access' => fake()->randomElement(['yes', 'no', 'banned']),
            'verified' => fake()->randomElement(['yes', 'no']),
            'email_verified_at' => now(),
            'password' => bcrypt('tempPass123'), // password
            'remember_token' => Str::random(10),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
