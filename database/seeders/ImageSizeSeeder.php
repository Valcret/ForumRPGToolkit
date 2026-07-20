<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSizeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('image_sizes')->insert([
            ['name' => '200x320'],
            ['name' => '200x400'],
            ['name' => '400x600'],
            ['name' => '320x200'],
        ]);
    }
}
