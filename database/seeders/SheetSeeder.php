<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PresentationSheet;
use App\Models\CurrentSheet;
use App\Models\Forum;
use App\Models\User;

class SheetSeeder extends Seeder
{
    public function run(): void
    {
        $forums = Forum::take(2)->get();
        $users  = User::all();

        $templates = [
            '<div class="sheet"><h1>{{nom}}</h1><p>Prénom : {{prenom}}</p><p>Âge : {{age}}</p></div>',
            '<section class="fiche"><h2>{{nom}}</h2><ul><li>Prénom : {{prenom}}</li><li>Âge : {{age}}</li></ul></section>',
        ];

        foreach ($forums as $index => $forum) {
            $sheet = PresentationSheet::create([
                'title'    => 'Fiche de présentation ' . $forum->name,
                'body'     => $templates[$index],
                'forum_id' => $forum->id,
            ]);

            foreach ($users as $user) {
                CurrentSheet::create([
                    'user_id'    => $user->id,
                    'sheet_id'   => $sheet->id,
                    'values'     => json_encode(['nom' => '', 'prenom' => '', 'age' => '']),
                    'expiration' => now()->addMonth(),
                ]);
            }
        }
    }
}
