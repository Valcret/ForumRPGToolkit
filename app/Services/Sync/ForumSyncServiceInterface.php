<?php

namespace App\Services\Sync;

use App\Models\Roleplay;

interface ForumSyncServiceInterface
{
    /**
     * Récupère les infos du dernier message connu pour ce RP.
     *
     * @return array{last_post_at: \Illuminate\Support\Carbon, last_post_author: string}|null
     */
    public function fetchLatestPost(Roleplay $roleplay): ?array;
}
