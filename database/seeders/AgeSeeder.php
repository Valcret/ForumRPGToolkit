<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ages')->insert([
            ['name' => '18-20 ans'],
            ['name' => '21-25 ans'],
            ['name' => '26-30 ans'],
            ['name' => '31-35 ans'],
            ['name' => '36-40 ans'],
            ['name' => '41-45 ans'],
            ['name' => '46-50 ans'],
            ['name' => '50 ans et plus'],
        ]);
    }
}
