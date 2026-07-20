<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Character;
use App\Models\Roleplay;
use App\Models\RoleplayStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddSection extends Component
{
    // ── Onglet actif ──────────────────────────────────────────
    public string $activeTab = 'rp';

    // ── Formulaire RP ─────────────────────────────────────────
    public ?int   $rp_forum_id      = null;
    public ?int   $rp_character_id  = null;   // pour le select
    public array  $rp_characters    = [];     // ids sélectionnés
    public array  $rp_character_names = [];   // pour l'affichage des tags
    public string $rp_name          = '';
    public string $rp_url           = '';

    // ── Formulaire Forum ──────────────────────────────────────
    public string $forum_name   = '';
    public string $forum_url    = '';
    public string $forum_button = '';
    public bool   $forum_nsfw   = false;

    // ── Formulaire Personnage ─────────────────────────────────
    public ?int   $char_forum_id = null;
    public string $char_name     = '';
    public string $char_url      = '';
    public ?int   $char_user_id  = null;

    // ── Computed : personnages filtrés par forum (onglet RP) ──
    public function getFilteredCharactersProperty(): array
    {
        if (!$this->rp_forum_id) return [];

        return Character::where('forum_id', $this->rp_forum_id)
            ->select('id', 'name')
            ->get()
            ->toArray();
    }

    // ── Ajouter un personnage au tag ──────────────────────────
    public function addCharacter(): void
    {
        if (!$this->rp_character_id) return;
        if (in_array($this->rp_character_id, $this->rp_characters)) return;

        $character = Character::find($this->rp_character_id);
        if (!$character) return;

        $this->rp_characters[]              = $this->rp_character_id;
        $this->rp_character_names[$this->rp_character_id] = $character->name;
        $this->rp_character_id = null; // reset le select
    }

    // ── Retirer un personnage du tag ──────────────────────────
    public function removeCharacter(int $id): void
    {
        $this->rp_characters = array_values(
            array_filter($this->rp_characters, fn($cid) => $cid !== $id)
        );
        unset($this->rp_character_names[$id]);
    }

    // ── Submit RP ─────────────────────────────────────────────
    public function saveRp(): void
    {
        $this->validate([
            'rp_forum_id'  => 'required|exists:forums,id',
            'rp_characters'=> 'required|array|min:1',
            'rp_name'      => 'required|string|max:255',
            'rp_url'       => 'nullable|url',
        ]);

        $rp = Roleplay::create([
            'name'       => $this->rp_name,
            'url'        => $this->rp_url ?: null,
            'forum_id'   => $this->rp_forum_id,
            'status_id'  => RoleplayStatus::where('name', 'Ouvert')->first()->id,
            'created_by' => Auth::id(),
            'started'    => now(),
        ]);

        foreach ($this->rp_characters as $index => $charId) {
            $rp->characters()->attach($charId, ['turn' => $index + 1]);
        }

        $this->reset(['rp_forum_id','rp_character_id','rp_characters',
            'rp_character_names','rp_name','rp_url']);

        session()->flash('success_rp', 'RP ajouté avec succès !');
    }

    // ── Submit Forum ──────────────────────────────────────────
    public function saveForum(): void
    {
        $this->validate([
            'forum_name'   => 'required|string|max:255|unique:forums,name',
            'forum_url'    => 'required|url',
            'forum_button' => 'nullable|url',
        ]);

        Forum::create([
            'name' => $this->forum_name,
            'alt'  => $this->forum_url,
            'nsfw' => $this->forum_nsfw,
        ]);

        $this->reset(['forum_name','forum_url','forum_button','forum_nsfw']);
        session()->flash('success_forum', 'Forum ajouté !');
    }

    // ── Submit Personnage ─────────────────────────────────────
    public function saveCharacter(): void
    {
        $this->validate([
            'char_forum_id' => 'required|exists:forums,id',
            'char_name'     => 'required|string|max:255',
            'char_url'      => 'nullable|url',
            'char_user_id'  => 'required|exists:users,id',
        ]);

        Character::create([
            'name'     => $this->char_name,
            'alt'      => $this->char_url ?: null,
            'forum_id' => $this->char_forum_id,
            'user_id'  => $this->char_user_id,
        ]);

        $this->reset(['char_forum_id','char_name','char_url','char_user_id']);
        session()->flash('success_char', 'Personnage ajouté !');
    }

    // ── Render ────────────────────────────────────────────────
    public function render()
    {
        return view('livewire.add-section', [
            'forums'   => Forum::orderBy('name')->get(),
            'statuses' => RoleplayStatus::all(),
            'users'    => User::orderBy('name')->get(),
        ]);
    }
    // ── Changer d'onglet ──────────────────────────────────────
    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
}
