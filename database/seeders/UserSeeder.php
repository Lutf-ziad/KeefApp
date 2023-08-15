<?php

namespace Database\Seeders;

// use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'phone' => '0504208520',
            'picture' => '',
            'birthday' => fake()->date(),
            'password' => bcrypt('password'),
            'notification' => 1,
            'email_notify' => 0,
            'support_code' => fake()->regexify('[A-Za-z]{10}'),
            'active' => 1,
            'email_verified_at' => now(),
            'phone_verified' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'phone' => '0504661818',
            'picture' => '',
            'birthday' => fake()->date(),
            'password' => bcrypt('password'),
            'notification' => 1,
            'email_notify' => 0,
            'support_code' => fake()->regexify('[A-Za-z]{10}'),
            'active' => 1,
            'email_verified_at' => now(),
            'phone_verified' => 1,
        ]);
        User::factory(10)->create();
    }
}
