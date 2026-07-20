<?php

namespace App\Services\Sync;

use App\Models\Forum;

class SyncServiceResolver
{
    public function __construct(
        private readonly PhpbbSyncService $phpbbSyncService,
        private readonly ForumactifSyncService $forumactifSyncService,
    ) {}

    public function resolve(Forum $forum): ForumSyncServiceInterface
    {
        return match ($forum->type) {
            'phpbb' => $this->phpbbSyncService,
            'forumactif' => $this->forumactifSyncService,
            default => throw new \InvalidArgumentException("Type de forum inconnu : {$forum->type}"),
        };
    }
}
