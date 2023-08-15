<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'type' => 'admin',
            'active' => 1,

        ]);
        DB::table('admins')->insert([
            'name' => 'owner',
            'password' => bcrypt('owner'),
            'type' => 'owner',
            'active' => 1,
            'shop_id' => Shop::limit('5')->get()->random()->id,

        ]);
        DB::table('admins')->insert([
            'name' => 'pos',
            'password' => bcrypt('pos'),
            'type' => 'pos',
            'active' => 1,
            'shop_id' => Shop::where('id', '>', 5)->get()->random()->id,

        ]);
        Admin::factory(25)->create();
    }
}
