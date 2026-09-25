<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Episode;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Console\Command;

class CleanTestDataCommand extends Command
{
    protected $signature = 'db:clean-test-data';

    protected $description = 'Remove test data, dummy episodes, and test users from database';

    public function handle(): int
    {
        $this->info('Cleaning test data from database...');

        // 1. Remove test users
        $deletedUsers = User::where('email', 'test@example.com')
            ->orWhere('email', 'like', '%test%')
            ->where('email', '!=', 'admin@listeningcommons.com')
            ->delete();
        $this->info("Removed {$deletedUsers} test users.");

        // 2. Remove mock dummy episodes that have no Spotify GUID
        $dummyEpisodes = Episode::whereNull('spotify_guid')->get();
        foreach ($dummyEpisodes as $ep) {
            $ep->themes()->detach();
            $ep->delete();
        }
        $this->info('Removed '.count($dummyEpisodes).' dummy mock episodes.');

        // 3. Remove dummy mock guests
        $deletedGuests = Guest::whereIn('slug', [
            'ambassador-david-k-osei',
            'tariq-al-mansoor',
            'maya-lin-hastings',
        ])->delete();
        $this->info("Removed {$deletedGuests} dummy guests.");

        // 4. Remove mock dummy articles without Substack sync
        $mockArticlesCount = Article::whereNull('substack_guid')->delete();
        $this->info("Removed {$mockArticlesCount} mock dummy articles.");

        // 5. Ensure real Spotify episodes are numbered 1 to N
        $spotifyEpisodes = Episode::whereNotNull('spotify_guid')->orderBy('published_at', 'asc')->get();
        $num = 1;
        foreach ($spotifyEpisodes as $ep) {
            $ep->episode_number = $num++;
            // Make sure the first one or latest is marked as featured
            $ep->is_featured = ($num === count($spotifyEpisodes) + 1); // latest featured
            $ep->save();
        }
        $this->info('Re-indexed '.count($spotifyEpisodes).' real Spotify episodes (1 to '.($num - 1).').');

        $this->info('All test data removed successfully! Database now only contains canonical data.');

        return self::SUCCESS;
    }
}
