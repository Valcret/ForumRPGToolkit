<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageInfo;

class ImageInfoSeeder extends Seeder
{
    public function run(): void
    {
        ImageInfo::insert([
            [
                'image_id'       => 1,
                'eyes_color_id'  => 1, // Bleu
                'hair_color_id'  => 2, // Brun
                'hair_length_id' => 3, // Court
                'size_id'        => 1, // [À COMPLÉTER]
                'history_id'     => 2, // Contemporain
                'beard_id'       => 1, // Aucune
                'age_id'         => 1, // [À COMPLÉTER]
                'image_size_id'  => 1, // [À COMPLÉTER]
                'gender_id'      => 1, // Homme
                'tattoo'         => false,
                'piercing'       => false,
                'nsfw'           => false,
            ],
            [
                'image_id'       => 2,
                'eyes_color_id'  => 3, // Marron
                'hair_color_id'  => 4, // Noir
                'hair_length_id' => 5, // Long
                'size_id'        => 2, // [À COMPLÉTER]
                'history_id'     => 1, // Fantaisie
                'beard_id'       => 1, // Aucune
                'age_id'         => 2, // [À COMPLÉTER]
                'image_size_id'  => 1, // [À COMPLÉTER]
                'gender_id'      => 2, // Femme
                'tattoo'         => false,
                'piercing'       => true,
                'nsfw'           => false,
            ],
            [
                'image_id'       => 3,
                'eyes_color_id'  => 2, // Vert
                'hair_color_id'  => 1, // Blond
                'hair_length_id' => 4, // Mi-long
                'size_id'        => 1, // [À COMPLÉTER]
                'history_id'     => 3, // Historique
                'beard_id'       => 4, // Barbe et moustache
                'age_id'         => 3, // [À COMPLÉTER]
                'image_size_id'  => 2, // [À COMPLÉTER]
                'gender_id'      => 1, // Homme
                'tattoo'         => true,
                'piercing'       => false,
                'nsfw'           => false,
            ],
        ]);
    }
}
