<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            UserSeeder::class,
            UserOtpSeeder::class,
            CategorySeeder::class,
            LevelSeeder::class,
            ShopSeeder::class,
            AdminSeeder::class,
            PackageSeeder::class,
            PromotionSeeder::class,
            OrderSeeder::class,
        ]);
        // Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations']);
        // Artisan::call("passport:install");
    }
}
