<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $forums = [
            [
                'name' => 'Petites indécences entre amis',
                'alt'  => 'https://petitesindecencesentreamis.fr/',
                'nsfw' => true,
            ],
            [
                'name' => 'DC-Comics Free',
                'alt'  => 'https://dc-comis-free.variousforum.com/',
                'nsfw' => true,
            ],
            [
                'name' => "20's Erneuerung",
                'alt'  => 'https://20serneuerung.forumactif.com/',
                'nsfw' => true,
            ],
            [
                'name' => "De sang et d'art",
                'alt'  => 'https://desangetdart.forumactif.com/',
                'nsfw' => true,
            ],
            [
                'name' => "Les chroniques d'Ambrosia",
                'alt'  => 'https://chroniqueambrosia.forumactif.org/',
                'nsfw' => false,
            ],
        ];

        foreach ($forums as $forum) {
            Forum::create($forum);
        }
    }
}
