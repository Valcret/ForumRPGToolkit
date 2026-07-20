<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageOtherSeeder extends Seeder
{
    public function run(): void
    {
        $image1 = Image::find(1);
        $image3 = Image::find(3);

        // syncWithoutDetaching → n'insère que si la relation n'existe pas déjà
        $image1->otherCriterias()->syncWithoutDetaching([3]); // Vitiligo
        $image3->otherCriterias()->syncWithoutDetaching([4]); // Cicatrices
    }
}
