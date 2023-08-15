<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $images = [
            'default-user1.jpg',
            'default-user2.jpg',
            'default-user3.png',
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->regexify('/^('.config('app.COUNTRY_KEYS').")\d{7}$/"),
            'picture' => $this->faker->randomElement($images),
            'birthday' => $this->faker->date(),
            'password' => bcrypt('password'),
            'notification' => $this->faker->randomElement([0, 1]),
            'email_notify' => $this->faker->randomElement([0, 1]),
            'support_code' => $this->faker->regexify('[A-Za-z]{10}'),
            'active' => $this->faker->randomElement([1, 0, 1]),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
