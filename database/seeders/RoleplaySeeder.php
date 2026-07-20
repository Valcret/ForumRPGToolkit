<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roleplay;
use App\Models\User;
use App\Models\Forum;
use App\Models\RoleplayStatus;

class RoleplaySeeder extends Seeder
{
    public function run(): void
    {
        $admin  = User::where('email', 'admin@admin.com')->first();
        $joueur = User::where('email', 'joueur@test.com')->first();

        $forumIds  = Forum::pluck('id', 'name');
        $statusIds = RoleplayStatus::pluck('id', 'name');

        $roleplays = [
            [
                'title'         => 'La nuit des masques',
                'url'          => 'https://petitesindecencesentreamis.fr/topic/1',
                'created_by'   => $admin->id,
                'forum_id'     => $forumIds['Petites indécences entre amis'],
                'status_id'    => $statusIds['En cours'],
                'started'      => '2023-01-15',
                'ended'        => null,
                'current_sum'  => 12,
                'max_turn'     => 20,
                'current_turn' => 6,
                'prequel'      => null,
                'sequel'       => null,
            ],
            [
                'title'         => 'Götter und Menschen',
                'url'          => 'https://20serneuerung.forumactif.com/topic/5',
                'created_by'   => $joueur->id,
                'forum_id'     => $forumIds["20's Erneuerung"],
                'status_id'    => $statusIds['Terminé'],
                'started'      => '2022-06-01',
                'ended'        => '2023-03-20',
                'current_sum'  => 30,
                'max_turn'     => 30,
                'current_turn' => 30,
                'prequel'      => null,
                'sequel'       => null,
            ],
            [
                'title'         => 'Le pacte de sang',
                'url'          => 'https://desangetdart.forumactif.com/topic/3',
                'created_by'   => $admin->id,
                'forum_id'     => $forumIds["De sang et d'art"],
                'status_id'    => $statusIds['Ouvert'],
                'started'      => '2023-09-10',
                'ended'        => null,
                'current_sum'  => 3,
                'max_turn'     => 15,
                'current_turn' => 3,
                'prequel'      => null,
                'sequel'       => null,
            ],
            [
                'title'         => 'Cendres et braises',
                'url'          => 'https://petitesindecencesentreamis.fr/topic/8',
                'created_by'   => $joueur->id,
                'forum_id'     => $forumIds['Petites indécences entre amis'],
                'status_id'    => $statusIds['En pause'],
                'started'      => '2023-05-20',
                'ended'        => null,
                'current_sum'  => 7,
                'max_turn'     => 25,
                'current_turn' => 4,
                'prequel'      => null,
                'sequel'       => null,
            ],
        ];

        foreach ($roleplays as $rp) {
            Roleplay::firstOrCreate(
                ['title' => $rp['title']],
                $rp
            );
        }
    }
}
