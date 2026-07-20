<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\PresentationSheet;
use App\Models\CurrentSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FichcraftController extends Controller
{
    // Page d'accueil Fichcraft — liste des forums
    public function index()
    {
        $forums = Forum::whereHas('presentationSheet')->get();
        return view('fichcraft.index', compact('forums'));
    }

    // Affiche le formulaire d'un forum spécifique
    public function show(Forum $forum)
    {
        $forums = Forum::whereHas('presentationSheet')->get(); // ← ajout

        $sheet  = PresentationSheet::where('forum_id', $forum->id)->firstOrFail();
        $fields = $sheet->extractFields();

        $currentSheet = null;
        if (Auth::check()) {
            $currentSheet = CurrentSheet::where('user_id', Auth::id())
                ->where('sheet_id', $sheet->id)
                ->first();
        }

        return view('fichcraft.show', compact('forums', 'forum', 'sheet', 'fields', 'currentSheet'));
    }


    // Sauvegarde les valeurs — nécessite d'être connecté
    public function store(Request $request, Forum $forum)
    {
        $sheet  = PresentationSheet::where('forum_id', $forum->id)->firstOrFail();
        $fields = $sheet->extractFields();

        $rules     = collect($fields)->mapWithKeys(fn($f) => [$f => 'nullable|string|max:500'])->toArray();
        $validated = $request->validate($rules);

        CurrentSheet::updateOrCreate(
            [
                'user_id'  => Auth::id(),
                'sheet_id' => $sheet->id,
            ],
            [
                'values'     => $validated,
                'expiration' => now()->addMonths(6),
            ]
        );

        return redirect()->route('fichcraft.show', $forum)->with('success', 'Fiche sauvegardée !');
    }
}
