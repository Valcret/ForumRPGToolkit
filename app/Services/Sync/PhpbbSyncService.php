<?php

namespace App\Services\Sync;

use App\Models\Roleplay;

class PhpbbSyncService implements ForumSyncServiceInterface
{
    public function fetchLatestPost(Roleplay $roleplay): ?array
    {
        throw new \RuntimeException('PhpbbSyncService : logique de connexion pas encore implémentée.');
    }
}
