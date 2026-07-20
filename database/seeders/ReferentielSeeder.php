<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EyesColor;
use App\Models\HairColor;
use App\Models\HairLength;
use App\Models\History;
use App\Models\Beard;
use App\Models\Gender;
use App\Models\OtherCriteria;
class ReferentielSeeder extends Seeder
{
    public function run(): void
    {
        EyesColor::insert([
            ['name' => 'Bleu'],
            ['name' => 'Vert'],
            ['name' => 'Marron'],
            ['name' => 'Noisette'],
            ['name' => 'Gris'],
            ['name' => 'Noir'],
            ['name' => 'Ambre'],
        ]);

        HairColor::insert([
            ['name' => 'Blond'],
            ['name' => 'Brun'],
            ['name' => 'Roux'],
            ['name' => 'Noir'],
            ['name' => 'Gris'],
            ['name' => 'Blanc'],
            ['name' => 'Châtain'],
        ]);

        HairLength::insert([
            ['name' => 'Chauve'],
            ['name' => 'Très court'],
            ['name' => 'Court'],
            ['name' => 'Mi-long'],
            ['name' => 'Long'],
            ['name' => 'Très long'],
        ]);

        History::insert([
            ['name' => 'Fantaisie'],
            ['name' => 'Contemporain'],
            ['name' => 'Historique'],
            ['name' => 'Science-fiction'],
            ['name' => 'Post-apocalyptique'],
            ['name' => 'Médiéval'],
        ]);

        Beard::insert([
            ['name' => 'Aucune'],
            ['name' => 'Moustache'],
            ['name' => 'Barbe'],
            ['name' => 'Barbe et moustache'],
        ]);

        Gender::insert([
            ['name' => 'Homme'],
            ['name' => 'Femme'],
            ['name' => 'Non-binaire'],
        ]);

        OtherCriteria::insert([
            ['name' => 'Albinisme'],
            ['name' => 'Handicap visible'],
            ['name' => 'Vitiligo'],
            ['name' => 'Cicatrices'],
            ['name' => 'Brûlures'],
        ]);
    }
}
