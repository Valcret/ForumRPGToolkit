<?php

namespace App\Console\Commands;

use App\Models\Roleplay;
use App\Services\Sync\SyncServiceResolver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncRoleplays extends Command
{
    protected $signature = 'roleplays:sync {--forum= : ID d’un forum spécifique à synchroniser}';

    protected $description = 'Synchronise le dernier message connu de chaque RP actif avec son forum d’origine';

    public function handle(SyncServiceResolver $resolver): int
    {
        $query = Roleplay::query()->whereNull('ended')->with('forum');

        if ($forumId = $this->option('forum')) {
            $query->where('forum_id', $forumId);
        }

        $roleplays = $query->get();
        $this->info("Synchronisation de {$roleplays->count()} RP...");

        foreach ($roleplays as $roleplay) {
            try {
                $result = $resolver->resolve($roleplay->forum)->fetchLatestPost($roleplay);

                if ($result) {
                    $roleplay->update([
                        'last_post_at' => $result['last_post_at'],
                        'last_post_author' => $result['last_post_author'],
                        'last_synced_at' => now(),
                    ]);
                }
            } catch (\Throwable $e) {
                $this->warn("Échec pour « {$roleplay->title} » : {$e->getMessage()}");
                Log::warning('Sync RP échouée', ['roleplay_id' => $roleplay->id, 'error' => $e->getMessage()]);
            }
        }

        $this->info('Terminé.');
        return self::SUCCESS;
    }
}
