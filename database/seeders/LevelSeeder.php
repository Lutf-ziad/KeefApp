<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            'name' => '+',
            'active' => 1,
        ]);
        DB::table('levels')->insert([
            'name' => '++',
            'active' => 1,
        ]);
        DB::table('levels')->insert([
            'name' => '+++',
            'active' => 1,
        ]);
    }
}
