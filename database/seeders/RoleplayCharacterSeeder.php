<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roleplay;
use App\Models\Character;
use Illuminate\Support\Facades\DB;

class RoleplayCharacterSeeder extends Seeder
{
    public function run(): void
    {
        $roleplays = Roleplay::pluck('id', 'title');
        $characters = Character::pluck('id', 'name');

        $associations = [
            // Forum : Petites indécences entre amis
            [
                'roleplay_id'  => $roleplays['La nuit des masques'],
                'character_id' => $characters['Aria Blackwood'],
                'turn'         => 1,
            ],
            [
                'roleplay_id'  => $roleplays['La nuit des masques'],
                'character_id' => $characters['Marcus Veil'],
                'turn'         => 2,
            ],
            [
                'roleplay_id'  => $roleplays['Cendres et braises'],
                'character_id' => $characters['Aria Blackwood'],
                'turn'         => 1,
            ],
            [
                'roleplay_id'  => $roleplays['Cendres et braises'],
                'character_id' => $characters['Marcus Veil'],
                'turn'         => 2,
            ],

            // Forum : 20's Erneuerung
            [
                'roleplay_id'  => $roleplays['Götter und Menschen'],
                'character_id' => $characters['Elsa Von Tracht'],
                'turn'         => 1,
            ],
            [
                'roleplay_id'  => $roleplays['Götter und Menschen'],
                'character_id' => $characters['Heinrich Braun'],
                'turn'         => 2,
            ],

            // Forum : De sang et d'art
            [
                'roleplay_id'  => $roleplays['Le pacte de sang'],
                'character_id' => $characters["Morrigan de l'Aube"],
                'turn'         => 1,
            ],
        ];

        foreach ($associations as $assoc) {
            DB::table('roleplay_characters')->updateOrInsert(
                [
                    'roleplay_id'  => $assoc['roleplay_id'],
                    'character_id' => $assoc['character_id'],
                ],
                ['turn' => $assoc['turn']]
            );
        }
    }
}
