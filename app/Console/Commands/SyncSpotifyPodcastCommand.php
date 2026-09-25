<?php

namespace App\Console\Commands;

use App\Services\SpotifyPodcastSyncService;
use Illuminate\Console\Command;

class SyncSpotifyPodcastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'podcast:sync-spotify {--url= : Optional custom Spotify/Anchor RSS feed URL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize podcast episodes from the Spotify for Creators / Anchor RSS feed';

    /**
     * Execute the console command.
     */
    public function handle(SpotifyPodcastSyncService $syncService): int
    {
        $feedUrl = $this->option('url') ?: config('podcast.spotify_rss_url');

        $this->info("Fetching podcast episodes from Spotify RSS feed: {$feedUrl}");

        $result = $syncService->sync($this->option('url'));

        if (! $result['success']) {
            $this->error($result['message']);

            return self::FAILURE;
        }

        $this->info($result['message']);
        $this->table(
            ['Feed Source', 'Total Episodes in Feed', 'New Episodes Imported', 'Existing Episodes Updated'],
            [
                [$result['feed_title'] ?? 'The Listening Commons', $result['total'], $result['created'], $result['updated']],
            ]
        );

        return self::SUCCESS;
    }
}
