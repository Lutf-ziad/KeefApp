<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    public function definition(): array
    {
        $images = [
            'default-coffee-shop-logo1.png',
            'default-coffee-shop-logo2.png',
            'default-coffee-shop-logo3.png',
            'default-coffee-shop-logo4.png',
            'default-coffee-shop-logo5.png',
        ];

        return [
            'name' => $this->faker->name(),
            'logo' => $this->faker->randomElement($images),
            'lat' => $this->faker->latitude(),
            'lon' => $this->faker->longitude(),
            'active' => $this->faker->randomElement([1, 0, 1]),
            'special' => $this->faker->randomElement([0, 0, 0, 1]),
            'level_id' => Level::select('id')->get()->random()->id,
            'category_id' => Category::select('id')->get()->random()->id,
            'parent_id' => null,
        ];
    }
}
