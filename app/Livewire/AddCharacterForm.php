<?php

namespace App\Livewire;

use App\Models\Character;
use App\Models\Forum;
use App\Models\User;
use App\Livewire\Concerns\WithFlashMessage;
use Livewire\Component;

class AddCharacterForm extends Component
{
    use WithFlashMessage;

    public string $name      = '';
    public string $alt       = '';
    public int|null $forum_id = null;
    public int|null $user_id  = null;

    protected $rules = [
        'name'     => 'required|string|max:255',
        'alt'      => 'nullable|url|max:255',
        'forum_id' => 'required|exists:forums,id',
        'user_id'  => 'required|exists:users,id',
    ];

    public function submit(): void
    {
        $this->validate();

        Character::create([
            'name'     => $this->name,
            'alt'      => $this->alt,
            'forum_id' => $this->forum_id,
            'user_id'  => $this->user_id,
        ]);

        $this->reset(['name', 'alt', 'forum_id', 'user_id']);
        $this->flash('Personnage ajouté avec succès !');
    }

    public function render()
    {
        return view('livewire.add-character-form', [
            'forums' => Forum::orderBy('name')->get(),
            'users'  => User::orderBy('name')->get(),
        ]);
    }
}
