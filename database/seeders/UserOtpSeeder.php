<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_otps')->insert([
            'user_id' => 1,
            'otp' => 123456,
            'expire_at' => now()->addYear(10),
        ]);
        DB::table('users_otps')->insert([
            'user_id' => 2,
            'otp' => 654321,
            'expire_at' => now()->addYear(10),
        ]);
    }
}
