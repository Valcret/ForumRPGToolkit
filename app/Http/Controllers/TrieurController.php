<?php

namespace App\Http\Controllers;

use App\Models\Roleplay;
use App\Models\RoleplayStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrieurController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupère tous les personnages de l'utilisateur
        $characterIds = $user->characters()->pluck('characters.id');

        // Récupère tous les RPs où l'utilisateur a au moins un personnage
        $baseQuery = Roleplay::whereHas('characters', function ($q) use ($characterIds) {
            $q->whereIn('characters.id', $characterIds);
        })->with(['characters', 'forum', 'status']);

        // PRIORITAIRES — RPs en favori de l'user
        $prioritaires = $user->favoriteRoleplays()
            ->with(['characters', 'forum', 'status'])
            ->orderByPivot('priority_order')
            ->get();

        // Statuts "actifs" (en cours, ouvert, en pause) — à adapter selon tes slugs
        $activeStatuses = RoleplayStatus::whereIn('name', [
            'En cours', 'Ouvert', 'En pause'
        ])->pluck('id');

        // RPs actifs avec personnage de l'user
        $rpsActifs = (clone $baseQuery)
            ->whereIn('status_id', $activeStatuses)
            ->get();

        // EN COURS — c'est au tour d'un personnage de l'user de répondre
        $enCours = $rpsActifs->filter(function ($rp) use ($characterIds) {
            return $rp->characters
                ->whereIn('id', $characterIds)
                ->where('pivot.turn', $rp->current_turn)
                ->isNotEmpty();
        });

        // EN ATTENTE — c'est au tour de quelqu'un d'autre
        $enAttente = $rpsActifs->filter(function ($rp) use ($characterIds) {
            return $rp->characters
                ->whereIn('id', $characterIds)
                ->where('pivot.turn', $rp->current_turn)
                ->isEmpty();
        });

        // ARCHIVÉS
        $archivedStatuses = RoleplayStatus::whereIn('name', [
            'Terminé', 'Abandonné'
        ])->pluck('id');

        $archives = (clone $baseQuery)
            ->whereIn('status_id', $archivedStatuses)
            ->get();

        // Forums et personnages de l'user pour les formulaires
        $forums = $user->forums ?? collect();
        $characters = $user->characters ?? collect();
        $statuses = RoleplayStatus::all();

        return view('trieur.index', compact(
            'prioritaires',
            'enCours',
            'enAttente',
            'archives',
            'forums',
            'characters',
            'statuses'
        ));
    }

    public function toggleFavorite(Roleplay $roleplay)
    {
        $user = Auth::user();
        $favorites = $user->favoriteRoleplays();

        if ($favorites->where('roleplay_id', $roleplay->id)->exists()) {
            $favorites->detach($roleplay->id);
            $message = 'Retiré des favoris';
        } else {
            // Priority order = dernier + 1
            $maxOrder = $favorites->max('priority_order') ?? 0;
            $favorites->attach($roleplay->id, ['priority_order' => $maxOrder + 1]);
            $message = 'Ajouté aux favoris';
        }

        return back()->with('success', $message);
    }

    public function updateStatus(Request $request, Roleplay $roleplay)
    {
        $request->validate([
            'status_id' => 'required|exists:roleplay_statuses,id'
        ]);

        $roleplay->update(['status_id' => $request->status_id]);

        return back()->with('success', 'Statut mis à jour');
    }
}
