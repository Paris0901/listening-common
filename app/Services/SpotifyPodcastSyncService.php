<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Guest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SpotifyPodcastSyncService
{
    /**
     * Synchronize episodes from a Spotify/Anchor RSS feed URL.
     *
     * @param  string|null  $customRssUrl  Optional RSS URL override
     * @return array<string, mixed>
     */
    public function sync(?string $customRssUrl = null): array
    {
        $feedUrl = $customRssUrl ?: config('podcast.spotify_rss_url');

        if (empty($feedUrl)) {
            return [
                'success' => false,
                'message' => 'No Spotify RSS Feed URL configured. Please set SPOTIFY_PODCAST_RSS_URL in your .env or provide a URL.',
                'created' => 0,
                'updated' => 0,
                'total' => 0,
            ];
        }

        try {
            $response = Http::timeout(20)->withHeaders([
                'User-Agent' => 'TheListeningCommons-SyncEngine/1.0 (+https://listeningcommons.com)',
            ])->get($feedUrl);

            if (! $response->successful()) {
                return [
                    'success' => false,
                    'message' => "Unable to fetch RSS feed from Spotify (HTTP {$response->status()}). Please verify the feed URL.",
                    'created' => 0,
                    'updated' => 0,
                    'total' => 0,
                ];
            }

            return $this->parseAndSyncXml($response->body(), $feedUrl);
        } catch (Exception $e) {
            Log::error('Spotify RSS sync error: '.$e->getMessage(), ['exception' => $e]);

            return [
                'success' => false,
                'message' => 'Error connecting to Spotify RSS feed: '.$e->getMessage(),
                'created' => 0,
                'updated' => 0,
                'total' => 0,
            ];
        }
    }

    /**
     * Parse raw RSS XML string and sync into the database.
     *
     * @return array<string, mixed>
     */
    public function parseAndSyncXml(string $xmlContent, string $feedUrl = ''): array
    {
        // Suppress libxml errors and parse
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($xml === false || ! isset($xml->channel)) {
            libxml_clear_errors();

            return [
                'success' => false,
                'message' => 'Invalid RSS XML format received from feed URL.',
                'created' => 0,
                'updated' => 0,
                'total' => 0,
            ];
        }

        $channel = $xml->channel;
        $channelTitle = (string) $channel->title;
        $channelItunes = $channel->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
        $channelArtwork = (string) ($channelItunes->image->attributes()['href'] ?? $channelItunes->image['href'] ?? $channel->image->url ?? '');

        // Resolve default fallback guest
        $defaultGuest = Guest::first() ?? Guest::create([
            'name' => 'Dr. Aninda Sidhana',
            'slug' => 'dr-aninda-sidhana',
            'designation' => 'Co-Creator & Clinical–Editorial Lead',
            'affiliation' => 'WICCI National Mental Health Council',
            'bio' => 'Psychiatrist and psychosexual-medicine specialist bridging mental health, human dignity, and lived experience.',
            'photo_url' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=800&q=80',
        ]);

        $createdCount = 0;
        $updatedCount = 0;
        $items = $channel->item ?? [];
        $totalItems = count($items);

        $nextEpisodeNumber = (int) (Episode::max('episode_number') ?? 0) + 1;

        foreach ($items as $item) {
            $itunes = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
            $content = $item->children('http://purl.org/rss/1.0/modules/content/');

            $guid = (string) ($item->guid ?? '');
            $title = trim((string) $item->title);
            $slug = Str::slug($title);

            // Audio enclosure
            $audioUrl = '';
            $audioBytes = 0;
            if (isset($item->enclosure)) {
                $audioUrl = (string) $item->enclosure['url'];
                $audioBytes = (int) ($item->enclosure['length'] ?? 0);
            }

            if (empty($audioUrl)) {
                continue; // Skip items without playable audio
            }

            // Description / Show Notes
            $rawDescription = (string) ($content->encoded ?? $item->description ?? '');
            $cleanDescription = strip_tags($rawDescription);
            $shortDescription = Str::limit($cleanDescription, 280, '...');

            // Duration calculation
            $durationRaw = (string) ($itunes->duration ?? '');
            $durationSeconds = $this->parseDurationToSeconds($durationRaw);

            // Artwork URL (read from itunes:image href attribute or fallback to channel artwork)
            $itemArtwork = (string) ($itunes->image->attributes()['href'] ?? $itunes->image['href'] ?? '');
            $artworkUrl = $itemArtwork ?: $channelArtwork;

            // Match existing episode
            $episode = null;
            if ($guid) {
                $episode = Episode::where('spotify_guid', $guid)->first();
            }

            if (! $episode && $audioUrl) {
                $episode = Episode::where('audio_url', $audioUrl)->first();
            }

            if (! $episode && $slug) {
                $episode = Episode::where('slug', $slug)->first();
            }

            // Episode & Season numbers
            $episodeNumber = (int) ($itunes->episode ?? 0);
            if ($episodeNumber <= 0) {
                $episodeNumber = ($episode && $episode->episode_number) ? $episode->episode_number : $nextEpisodeNumber++;
            }

            // Publish timestamp
            $publishedAt = $item->pubDate ? Carbon::parse((string) $item->pubDate) : now();

            // Determine guest association
            $guestId = $defaultGuest->id;
            if ($episode && $episode->guest_id) {
                $guestId = $episode->guest_id;
            }

            $episodeData = [
                'title' => $title,
                'slug' => $episode ? $episode->slug : $slug,
                'episode_number' => $episodeNumber,
                'guest_id' => $guestId,
                'host_names' => (string) ($itunes->author ?? 'Scott Douglas Jacobsen & Dr. Aninda Sidhana'),
                'short_description' => $shortDescription ?: 'A conversation from The Listening Commons.',
                'full_show_notes' => $rawDescription ?: $shortDescription,
                'audio_url' => $audioUrl,
                'audio_duration_seconds' => $durationSeconds,
                'audio_bytes' => $audioBytes,
                'artwork_url' => $artworkUrl ?: $defaultGuest->photo_url,
                'spotify_guid' => $guid,
                'spotify_url' => (string) ($item->link ?? 'https://open.spotify.com/show/listeningcommons'),
                'spotify_synced_at' => now(),
                'is_published' => true,
                'published_at' => $publishedAt,
            ];

            if ($episode) {
                // Update existing episode with fresh audio CDN link and metadata
                $episode->update($episodeData);
                $updatedCount++;
            } else {
                // Create new imported episode
                Episode::create($episodeData);
                $createdCount++;
            }
        }

        return [
            'success' => true,
            'message' => "Successfully synced {$totalItems} episodes from Spotify RSS feed! ({$createdCount} new imported, {$updatedCount} updated).",
            'feed_title' => $channelTitle,
            'feed_url' => $feedUrl,
            'total' => $totalItems,
            'created' => $createdCount,
            'updated' => $updatedCount,
        ];
    }

    /**
     * Convert various duration formats (HH:MM:SS, MM:SS, or seconds) to integer seconds.
     */
    protected function parseDurationToSeconds(string $duration): int
    {
        $duration = trim($duration);

        if (empty($duration)) {
            return 3300; // Default ~55 mins
        }

        if (is_numeric($duration)) {
            return (int) $duration;
        }

        $parts = array_map('intval', explode(':', $duration));

        if (count($parts) === 3) {
            return ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
        }

        if (count($parts) === 2) {
            return ($parts[0] * 60) + $parts[1];
        }

        return 3300;
    }
}
