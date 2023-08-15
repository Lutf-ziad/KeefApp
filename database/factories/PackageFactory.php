<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'desc' => $this->faker->sentence(),
            'cups' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2, 100, 300),
            'active' => $this->faker->randomElement([1, 0, 1]),
            'level_id' => Level::select('id')->get()->random()->id,
        ];
    }
}
