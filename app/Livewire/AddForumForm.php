<?php

namespace App\Livewire;

use App\Models\Forum;
use App\Livewire\Concerns\WithFlashMessage;
use Livewire\Component;

class AddForumForm extends Component
{
    use WithFlashMessage;

    public string $name   = '';
    public string $url    = '';
    public string $button = '';
    public bool   $nsfw   = false;

    protected $rules = [
        'name'   => 'required|string|max:255',
        'url'    => 'required|url|max:255|unique:forums,alt',  // ← colonne réelle
        'button' => 'nullable|url|max:255',
        'nsfw'   => 'boolean',
    ];

    public function submit(): void
    {
        $this->validate();

        Forum::create([
            'name'   => $this->name,
            'alt'    => $this->url,
            'button' => $this->button ?: null,
            'nsfw'   => $this->nsfw,
        ]);

        $this->reset(['name', 'url', 'button', 'nsfw']);
        $this->flash('Forum ajouté avec succès !');
    }


    public function render()
    {
        return view('livewire.add-forum-form');
    }
}
