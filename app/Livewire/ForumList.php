<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;

class ForumList extends Component
{
    public bool $showRpModal = false;
    public bool $showCharacterModal = false;
    public ?int $selectedForumId = null;

    public function openRpList(int $forumId): void
    {
        $this->selectedForumId = $forumId;
        $this->showRpModal = true;
    }

    public function openCharacterList(int $forumId): void
    {
        $this->selectedForumId = $forumId;
        $this->showCharacterModal = true;
    }

    public function closeModals(): void
    {
        $this->showRpModal = false;
        $this->showCharacterModal = false;
        $this->selectedForumId = null;
    }

    public function getSelectedForumRoleplaysProperty()
    {
        if (!$this->selectedForumId) return collect();

        return \App\Models\Roleplay::whereHas('characters', function ($query) {
            $query->where('user_id', auth()->id())
                ->where('forum_id', $this->selectedForumId);
        })->with('characters')->get();
    }

    public function getSelectedForumCharactersProperty()
    {
        if (!$this->selectedForumId) return collect();

        return auth()->user()
            ->characters()
            ->where('forum_id', $this->selectedForumId)
            ->get();
    }

    public function render()
    {
        $forums = Forum::whereHas('characters', function ($query) {
            $query->where('user_id', auth()->id())
                ->where('archived', false);
        })->get();

        return view('livewire.forum-list', [
            'forums' => $forums,
        ]);
    }
}
