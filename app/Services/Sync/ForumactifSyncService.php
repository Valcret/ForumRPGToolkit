<?php

namespace App\Services\Sync;

use App\Models\Roleplay;

class ForumactifSyncService implements ForumSyncServiceInterface
{
    public function fetchLatestPost(Roleplay $roleplay): ?array
    {
        throw new \RuntimeException('ForumactifSyncService : logique de scraping pas encore implémentée.');
    }
}
