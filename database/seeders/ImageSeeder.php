<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            ['name' => 'image1.jpg', 'url' => 'faceclaims/image1.jpg'],
            ['name' => 'image2.jpg', 'url' => 'faceclaims/image2.jpg'],
            ['name' => 'image3.jpg', 'url' => 'faceclaims/image3.jpg'],
        ];

        foreach ($images as $image) {
            Image::firstOrCreate(
                ['name' => $image['name']],
                ['url'  => $image['url']]
            );
        }
    }
}
