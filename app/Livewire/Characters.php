<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Character;
use App\Models\Roleplay;

class Characters extends Component
{
    // ── Archivage personnage ──────────────────────────────
    public bool $showArchiveModal = false;
    public ?int $characterToArchive = null;

    // ── Modale liste RPs ──────────────────────────────────
    public bool $showRpListModal = false;
    public ?int $selectedCharacterId = null;

    // ── Archivage personnage ──────────────────────────────

    public function confirmArchiveCharacter(int $characterId): void
    {
        $this->characterToArchive = $characterId;
        $this->showArchiveModal = true;
    }

    public function archiveCharacter(): void
    {
        $character = Character::where('id', $this->characterToArchive)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $rpIds = $character->roleplays()->pluck('roleplays.id');

        Roleplay::whereIn('id', $rpIds)->update([
            'status_id'   => 2,
            'archived_by' => auth()->id(),
        ]);

        $character->update(['archived' => true]);

        $this->showArchiveModal = false;
        $this->characterToArchive = null;
    }

    public function cancelArchive(): void
    {
        $this->showArchiveModal = false;
        $this->characterToArchive = null;
    }

    // ── Modale liste RPs ──────────────────────────────────

    public function openRpList(int $characterId): void
    {
        abort_unless(
            Character::where('id', $characterId)
                ->where('user_id', auth()->id())
                ->exists(),
            403
        );

        $this->selectedCharacterId = $characterId;
        $this->showRpListModal = true;
    }

    public function closeRpList(): void
    {
        $this->showRpListModal = false;
        $this->selectedCharacterId = null;
    }

    // ── Computed ──────────────────────────────────────────

    #[Computed]
    public function selectedCharacterRoleplays()
    {
        if (! $this->selectedCharacterId) {
            return collect();
        }

        return Roleplay::whereHas('characters', function ($q) {
            $q->where('characters.id', $this->selectedCharacterId);
        })
            ->with(['forum', 'characters', 'favoritedByUsers'])
            ->orderByDesc('updated_at')
            ->get();
    }

    // ── Render ───────────────────────────────────────────

    public function render()
    {
        $forums = auth()->user()
            ->characters()
            ->where('archived', false)
            ->with('forum')
            ->get()
            ->groupBy('forum_id');

        // ✅ Ajout
        $archivedCharacters = auth()->user()
            ->characters()
            ->where('archived', true)
            ->with('forum')
            ->get();

        return view('livewire.characters', [
            'forums'             => $forums,
            'archivedCharacters' => $archivedCharacters,
        ]);
    }

}
