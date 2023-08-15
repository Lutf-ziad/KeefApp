<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert(
            [
                'setting_key' => 'splash_image',
                'setting_label' => 'Splash Image',
                'setting_value' => 'splash_image.png',
            ]
        );
        DB::table('settings')->insert(
            [
                'setting_key' => 'splash_video',
                'setting_label' => 'Splash Video Promotion',
                'setting_value' => 'splash_promotion.mp4',
            ]
        );
        DB::table('settings')->insert(
            [
                'setting_key' => 'splash_duration',
                'setting_label' => 'Splash Duration',
                'setting_value' => 3,
            ]
        );
    }
}
