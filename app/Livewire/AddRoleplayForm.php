<?php

namespace App\Livewire;

use App\Models\Roleplay;
use App\Models\Character;
use App\Models\Forum;
use App\Models\RoleplayStatus;
use App\Livewire\Concerns\WithFlashMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddRoleplayForm extends Component
{
    use WithFlashMessage;

    public string   $title              = '';
    public string   $url                = '';
    public int|null $forum_id           = null;
    public int|null $character_id       = null;
    public array    $selectedCharacters = [];

    protected $rules = [
        'title'                => 'required|string|max:255',
        'url'                  => 'nullable|max:255',
        'forum_id'             => 'nullable|exists:forums,id',
        'selectedCharacters'   => 'required|array|min:1',
        'selectedCharacters.*' => 'exists:characters,id',
    ];

    public function updatedForumId(): void
    {
        $this->selectedCharacters = [];
        $this->character_id       = null;
    }

    public function updatedCharacterId(?int $value): void
    {
        if ($value && !in_array($value, $this->selectedCharacters)) {
            $this->selectedCharacters[] = $value;
        }
        $this->character_id = null;
    }

    public function removeCharacter(int $characterId): void
    {
        $this->selectedCharacters = array_values(
            array_filter($this->selectedCharacters, fn($id) => $id !== $characterId)
        );
    }

    public function submit(): void
    {
        $this->validate();

        $hasOwnCharacter = Character::whereIn('id', $this->selectedCharacters)
            ->where('user_id', Auth::id())
            ->exists();

        if (!$hasOwnCharacter) {
            $this->addError('selectedCharacters', 'Tu dois inclure au moins un de tes personnages.');
            return;
        }

        $defaultStatus = RoleplayStatus::where('name', 'En cours')->value('id');

        $roleplay = Roleplay::create([
            'title'         => $this->title,
            'url'           => $this->url ?: null,
            'status_id'     => $defaultStatus,
            'forum_id'      => $this->forum_id,
            'created_by'    => Auth::id(),
            'current_turn'  => 1,
            'max_turn'      => count($this->selectedCharacters),
        ]);

        // Attribution des turns selon l'ordre d'ajout
        $pivotData = [];
        foreach ($this->selectedCharacters as $index => $characterId) {
            $pivotData[$characterId] = ['turn' => $index + 1];
        }

        $roleplay->characters()->attach($pivotData);

        $this->reset(['title', 'url', 'forum_id', 'character_id', 'selectedCharacters']);
        $this->flash('Roleplay ajouté avec succès !');
    }


    public function render()
    {
        $characters = $this->forum_id
            ? Character::where('forum_id', $this->forum_id)->get()
            : collect();

        return view('livewire.add-roleplay-form', [
            'forums'     => Forum::orderBy('name')->get(),
            'characters' => $characters,
        ]);
    }
}
