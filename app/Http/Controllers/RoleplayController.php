<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roleplay;
use App\Models\Forum;
use App\Models\Character;
use App\Models\RoleplayStatus;
use Illuminate\Support\Facades\Auth;

class RoleplayController extends Controller
{
    /**
     * Retourne les personnages d'un forum en JSON (pour le JS)
     */
    public function charactersByForum(Forum $forum)
    {
        $characters = Character::where('forum_id', $forum->id)
            ->select('id', 'name', 'user_id')
            ->get();

        return response()->json($characters);
    }

    /**
     * Enregistre un nouveau RP
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'url'          => 'required|url',
            'forum_id'     => 'required|exists:forums,id',
            'status_id'    => 'required|exists:roleplay_statuses,id',
            'character_ids'=> 'required|array|min:1',
            'character_ids.*' => 'exists:characters,id',
        ]);

        // Vérif : au moins un personnage appartient à l'user connecté
        $userCharacters = Character::whereIn('id', $request->character_ids)
            ->where('user_id', Auth::id())
            ->count();

        if ($userCharacters === 0) {
            return back()
                ->withErrors(['character_ids' => 'Tu dois inclure au moins un de tes personnages.'])
                ->withInput();
        }

        // Création du RP
        $roleplay = Roleplay::create([
            'name'       => $request->name,
            'url'        => $request->url,
            'forum_id'   => $request->forum_id,
            'status_id'  => $request->status_id,
            'created_by' => Auth::id(),
            'started'    => now(),
        ]);

        // Association des personnages
        foreach ($request->character_ids as $index => $characterId) {
            $roleplay->characters()->attach($characterId, ['turn' => $index + 1]);
        }

        return back()->with('success', 'RP ajouté avec succès !');
    }
}
