<?php

namespace App\Services;

use App\Models\Article;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SubstackNewsletterSyncService
{
    /**
     * Ingest and synchronize all articles/letters from configured Substack RSS feeds.
     *
     * @param  array<string>|string|null  $feedUrls
     * @return array{success: bool, message: string, total: int, created: int, updated: int}
     */
    public function syncAll(array|string|null $feedUrls = null): array
    {
        if (empty($feedUrls)) {
            $feedUrls = config('newsletter.substack_feed_urls', ['https://dranindasidhana.substack.com/feed']);
        }

        if (is_string($feedUrls)) {
            $feedUrls = [$feedUrls];
        }

        $totalFound = 0;
        $totalCreated = 0;
        $totalUpdated = 0;

        foreach ($feedUrls as $feedUrl) {
            $result = $this->syncFeed(trim($feedUrl));
            if ($result['success']) {
                $totalFound += $result['total'];
                $totalCreated += $result['created'];
                $totalUpdated += $result['updated'];
            }
        }

        return [
            'success' => true,
            'message' => "Substack sync complete: {$totalFound} letters processed ({$totalCreated} imported, {$totalUpdated} updated).",
            'total' => $totalFound,
            'created' => $totalCreated,
            'updated' => $totalUpdated,
        ];
    }

    /**
     * Ingest and synchronize articles from a single Substack RSS feed URL.
     *
     * @return array{success: bool, message: string, total: int, created: int, updated: int}
     */
    public function syncFeed(string $feedUrl): array
    {
        Log::info("Starting Substack newsletter sync from: {$feedUrl}");

        try {
            $response = Http::timeout(25)
                ->withHeaders([
                    'User-Agent' => 'TheListeningCommons/2.0 (+https://listeningcommons.com)',
                    'Accept' => 'application/rss+xml, application/xml, text/xml',
                ])
                ->get($feedUrl);

            if (! $response->successful()) {
                Log::warning("Substack feed responded with HTTP status {$response->status()} for {$feedUrl}");

                return [
                    'success' => false,
                    'message' => "Substack feed unreachable (HTTP {$response->status()}).",
                    'total' => 0,
                    'created' => 0,
                    'updated' => 0,
                ];
            }

            $xml = @simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);

            if (! $xml || ! isset($xml->channel)) {
                return [
                    'success' => false,
                    'message' => 'Invalid RSS XML format received from Substack feed.',
                    'total' => 0,
                    'created' => 0,
                    'updated' => 0,
                ];
            }

            $channel = $xml->channel;
            $channelTitle = trim((string) $channel->title);
            $items = $channel->item ?? [];
            $totalItems = count($items);

            $createdCount = 0;
            $updatedCount = 0;

            foreach ($items as $item) {
                $dc = $item->children('http://purl.org/dc/elements/1.1/');
                $content = $item->children('http://purl.org/rss/1.0/modules/content/');
                $itunes = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');

                $guid = trim((string) ($item->guid ?? ''));
                $title = trim((string) $item->title);
                $link = trim((string) $item->link);

                if (empty($title) || empty($link)) {
                    continue;
                }

                // Author resolution
                $author = trim((string) ($dc->creator ?? 'Dr. Aninda Sidhana'));
                if (empty($author)) {
                    $author = 'Dr. Aninda Sidhana';
                }

                // Content body and summary
                $encodedContent = (string) ($content->encoded ?? '');
                $rawDescription = (string) ($item->description ?? '');
                $cleanBody = $encodedContent ?: $rawDescription;

                $cleanText = strip_tags($rawDescription ?: $encodedContent);
                $summary = Str::limit(trim($cleanText), 350, '...');

                // Cover artwork
                $coverUrl = null;
                if (isset($item->enclosure) && ! empty($item->enclosure['url'])) {
                    $coverUrl = (string) $item->enclosure['url'];
                } elseif (isset($itunes->image)) {
                    $coverUrl = (string) ($itunes->image->attributes()['href'] ?? $itunes->image['href'] ?? '');
                }

                // If no enclosure, attempt to extract first <img> from body
                if (empty($coverUrl) && ! empty($cleanBody)) {
                    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $cleanBody, $matches)) {
                        $coverUrl = $matches[1];
                    }
                }

                // Publication date
                $publishedAt = $item->pubDate ? Carbon::parse((string) $item->pubDate) : now();

                // Find existing article by substack_guid, substack_url, or slug
                $article = null;
                if ($guid) {
                    $article = Article::where('substack_guid', $guid)->first();
                }

                if (! $article && $link) {
                    $article = Article::where('substack_url', $link)->first();
                }

                $slug = Str::slug($title);
                if (! $article && $slug) {
                    $article = Article::where('slug', $slug)->first();
                }

                // Ensure slug uniqueness if creating new
                if (! $article) {
                    $baseSlug = $slug;
                    $counter = 1;
                    while (Article::where('slug', $slug)->exists()) {
                        $slug = "{$baseSlug}-{$counter}";
                        $counter++;
                    }
                }

                $articleData = [
                    'title' => $title,
                    'slug' => $article ? $article->slug : $slug,
                    'author_name' => $author,
                    'summary' => $summary ?: 'A written reflection from The Listening Commons.',
                    'body' => $cleanBody ?: $summary,
                    'cover_url' => $coverUrl ?: ($article ? $article->cover_url : null),
                    'substack_guid' => $guid ?: $link,
                    'substack_url' => $link,
                    'substack_synced_at' => now(),
                    'published_at' => $publishedAt,
                    'is_published' => true,
                ];

                if ($article) {
                    $article->update($articleData);
                    $updatedCount++;
                } else {
                    Article::create($articleData);
                    $createdCount++;
                }
            }

            Log::info("Synced Substack publication '{$channelTitle}': {$createdCount} imported, {$updatedCount} updated.");

            return [
                'success' => true,
                'message' => "Successfully synced {$totalItems} newsletters from '{$channelTitle}'.",
                'total' => $totalItems,
                'created' => $createdCount,
                'updated' => $updatedCount,
            ];
        } catch (Exception $e) {
            Log::error("Substack sync failed for {$feedUrl}: {$e->getMessage()}");

            return [
                'success' => false,
                'message' => "Sync error: {$e->getMessage()}",
                'total' => 0,
                'created' => 0,
                'updated' => 0,
            ];
        }
    }
}
