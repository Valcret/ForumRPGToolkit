<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['name' => '1m50 ou moins'],
            ['name' => '1m50 - 1m60'],
            ['name' => '1m60 - 1m70'],
            ['name' => '1m70 - 1m80'],
            ['name' => '1m80 - 1m90'],
            ['name' => '1m90 et plus'],
        ]);
    }
}
