<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Roleplay;
use Illuminate\Support\Collection;

class RoleplayTracker extends Component
{
    public string $activeTab = 'prioritaires';
    public ?int $confirmArchiveId = null;
    public ?int $confirmUnarchiveId = null;

    public function getRoleplaysProperty(): Collection
    {
        $userId = auth()->id();

        return Roleplay::whereHas('characters', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->with([
                'characters',
                'forum',
                'status',
                'favoritedByUsers' => fn($q) => $q->where('user_id', $userId)
            ])
            ->get();
    }

    public function getPrioritairesProperty(): Collection
    {
        return $this->roleplays
            ->filter(fn($rp) =>
                $rp->favoritedByUsers->isNotEmpty() &&
                $rp->status_id !== 2
            )
            ->sortBy(fn($rp) => $rp->favoritedByUsers->first()->pivot->priority_order);
    }

    public function getEnCoursProperty(): Collection
    {
        return $this->roleplays->filter(fn($rp) =>
            $rp->status_id !== 2 && $this->isMyTurn($rp)
        );
    }

    public function getEnAttenteProperty(): Collection
    {
        return $this->roleplays->filter(fn($rp) =>
            $rp->status_id !== 2 && !$this->isMyTurn($rp)
        );
    }

    public function getArchivesProperty(): Collection
    {
        return $this->roleplays->filter(fn($rp) => $rp->status_id === 2);
    }

    private function isMyTurn(Roleplay $rp): bool
    {
        return $rp->characters
                ->firstWhere('pivot.turn', $rp->current_turn)
                ?->user_id === auth()->id();
    }

    // --- REPLY ---
    public function reply(int $roleplayId): void
    {
        $rp = Roleplay::findOrFail($roleplayId);

        if (!$this->isMyTurn($rp)) {
            return;
        }

        $next = $rp->current_turn + 1;
        $rp->current_turn = $next > $rp->max_turn ? 1 : $next;
        $rp->save();
    }

    // --- FORCE REPLY (en attente, tous les participants) ---
    public function forceReply(int $roleplayId): void
    {
        $userId = auth()->id();
        $rp = Roleplay::findOrFail($roleplayId);

        $isParticipant = $rp->characters()
            ->where('user_id', $userId)
            ->exists();

        if (!$isParticipant) return;

        $next = $rp->current_turn + 1;
        $rp->current_turn = $next > $rp->max_turn ? 1 : $next;
        $rp->save();
    }

    // --- FAVORIS ---
    public function toggleFavorite(int $roleplayId): void
    {
        $rp = Roleplay::findOrFail($roleplayId);
        $userId = auth()->id();
        $user = auth()->user();

        $isFavorite = $rp->favoritedByUsers()
            ->where('user_id', $userId)
            ->exists();

        if ($isFavorite) {
            $rp->favoritedByUsers()->detach($userId);

            $user->favoriteRoleplays()
                ->orderByPivot('priority_order', 'asc')
                ->get()
                ->each(function ($favRp, $index) use ($userId) {
                    $favRp->favoritedByUsers()->updateExistingPivot($userId, [
                        'priority_order' => $index + 1
                    ]);
                });

        } else {
            $maxOrder = $user->favoriteRoleplays()
                ->max('roleplay_favorites.priority_order') ?? 0;

            $rp->favoritedByUsers()->attach($userId, [
                'priority_order' => $maxOrder + 1
            ]);
        }
    }

    // --- ARCHIVAGE ---
    public function confirmArchive(int $roleplayId): void
    {
        $this->confirmArchiveId = $roleplayId;
    }

    public function archive(): void
    {
        if (!$this->confirmArchiveId) return;

        $rp = Roleplay::findOrFail($this->confirmArchiveId);
        $userId = auth()->id();
        $user = auth()->user();

        $rp->status_id = 2;
        $rp->archived_by = $userId;
        $rp->save();

        $rp->favoritedByUsers()->detach($userId);

        $user->favoriteRoleplays()
            ->orderByPivot('priority_order', 'asc')
            ->get()
            ->each(function ($favRp, $index) use ($userId) {
                $favRp->favoritedByUsers()->updateExistingPivot($userId, [
                    'priority_order' => $index + 1
                ]);
            });

        $this->confirmArchiveId = null;
    }

    public function cancelArchive(): void
    {
        $this->confirmArchiveId = null;
    }

    // --- DÉSARCHIVAGE ---
    public function confirmUnarchive(int $roleplayId): void
    {
        $this->confirmUnarchiveId = $roleplayId;
    }

    public function unarchive(): void
    {
        if (!$this->confirmUnarchiveId) return;

        $rp = Roleplay::findOrFail($this->confirmUnarchiveId);

        if ($rp->archived_by !== auth()->id()) {
            session()->flash('error', 'Tu n\'es pas autorisé à désarchiver ce roleplay.');
            $this->confirmUnarchiveId = null;
            return;
        }

        $rp->status_id = 1;
        $rp->archived_by = null;
        $rp->save();

        $this->confirmUnarchiveId = null;
    }

    public function cancelUnarchive(): void
    {
        $this->confirmUnarchiveId = null;
    }

    public function render()
    {
        return view('livewire.roleplay-tracker');
    }
}
