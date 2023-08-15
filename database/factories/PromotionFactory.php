<?php

namespace Database\Factories;

use App\Enums\PromotionType;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fromDate = date('Y-m-d H:i:s');
        $toDate = Carbon::now()->addDays(random_int(3, 60))->format('Y-m-d H:i:s');

        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'title' => $this->faker->sentence(),
            'from' => $fromDate,
            'to' => $toDate,
            'type' => $this->faker->randomElement(PromotionType::values()),
            'amount' => $this->faker->randomElement([$this->faker->randomNumber(2)]),
            'valid_number' => $this->faker->randomElement([$this->faker->randomNumber(2), null]),
            'active' => $this->faker->randomElement([1, 0, 1, 1]),
            'package_id' => $this->faker->randomElement([Package::all()->random()->id, null]),
        ];
    }
}
