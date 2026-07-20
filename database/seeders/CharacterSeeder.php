<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;
use App\Models\Forum;
use App\Models\User;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $admin  = User::where('email', 'admin@admin.com')->first();
        $joueur = User::where('email', 'joueur@test.com')->first();

        $forumIds = Forum::pluck('id', 'name');

        $characters = [
            [
                'name'     => 'Aria Blackwood',
                'alt'      => 'Aria B.',
                'avatar'   => 'https://placehold.co/200x200',
                'forum_id' => $forumIds['Petites indécences entre amis'],
                'user_id'  => $admin->id,
            ],
            [
                'name'     => 'Marcus Veil',
                'alt'      => null,
                'avatar'   => null,
                'forum_id' => $forumIds['Petites indécences entre amis'],
                'user_id'  => $joueur->id,
            ],
            [
                'name'     => 'Diana Prince',
                'alt'      => 'Wonder Woman',
                'avatar'   => 'https://placehold.co/200x200',
                'forum_id' => $forumIds['DC-Comics Free'],
                'user_id'  => $admin->id,
            ],
            [
                'name'     => 'Elsa Von Tracht',
                'alt'      => null,
                'avatar'   => 'https://placehold.co/200x200',
                'forum_id' => $forumIds["20's Erneuerung"],
                'user_id'  => $joueur->id,
            ],
            [
                'name'     => 'Heinrich Braun',
                'alt'      => 'Heini',
                'avatar'   => null,
                'forum_id' => $forumIds["20's Erneuerung"],
                'user_id'  => $admin->id,
            ],
            [
                'name'     => "Morrigan de l'Aube",
                'alt'      => null,
                'avatar'   => null,
                'forum_id' => $forumIds["De sang et d'art"],
                'user_id'  => $joueur->id,
            ],
            // "Les chroniques d'Ambrosia" → aucun personnage volontairement
        ];

        foreach ($characters as $character) {
            // firstOrCreate sur 'name' → pas de doublon si seed relancé
            Character::firstOrCreate(
                ['name' => $character['name']],
                $character
            );
        }
    }
}
