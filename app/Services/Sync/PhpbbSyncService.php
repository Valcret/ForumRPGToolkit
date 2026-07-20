<?php

namespace App\Services\Sync;

use App\Models\Forum;
use App\Models\Roleplay;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PhpbbSyncService implements ForumSyncServiceInterface
{
    public function fetchLatestPost(Roleplay $roleplay): ?array
    {
        $forum = $roleplay->forum;
        $topicId = $this->extractTopicId($roleplay->url);

        if (!$topicId) {
            throw new \RuntimeException("Impossible d'extraire le topic_id depuis : {$roleplay->url}");
        }

        $connection = $this->registerConnection($forum);

        $topic = DB::connection($connection)
            ->table('topics')
            ->where('topic_id', $topicId)
            ->first(['topic_last_post_time', 'topic_last_poster_name']);

        if (!$topic) {
            return null;
        }

        return [
            'last_post_at' => Carbon::createFromTimestamp($topic->topic_last_post_time),
            'last_post_author' => $topic->topic_last_poster_name,
        ];
    }

    private function registerConnection(Forum $forum): string
    {
        $name = "phpbb_{$forum->id}";

        config(["database.connections.{$name}" => [
            'driver' => 'mysql',
            'host' => $forum->db_host,
            'port' => $forum->db_port ?? 3306,
            'database' => $forum->db_database,
            'username' => $forum->db_username,
            'password' => $forum->db_password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => $forum->table_prefix ?? 'phpbb_',
        ]]);

        return $name;
    }

    private function extractTopicId(string $url): ?int
    {
        parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $params);
        return isset($params['t']) ? (int) $params['t'] : null;
    }
}
