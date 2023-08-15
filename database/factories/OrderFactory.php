<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date_added' => now(),
            'user_id' => User::all()->random()->id,
            'shop_id' => Shop::all()->random()->id,
            'active' => $this->faker->randomElement([1, 1, 0, 1, 1]),
            'rate' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
