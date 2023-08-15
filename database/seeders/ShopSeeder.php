<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shop::factory(20)->hasProducts(10)->create()->each(function (Shop $shop) {
            if ($shop->id > 5) {
                $shop->parent_id = Shop::select('id')->limit(5)->get()->random()->id;
                $shop->save();
            }
        });
    }
}
