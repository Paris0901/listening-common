<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ListeningCommonsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    /**
     * Single Master Podcast RSS Feed (Spotify for Creators / Anchor).
     * Redirects to the master feed so no duplicate second feed is created.
     */
    public function podcastRss(): RedirectResponse
    {
        return redirect()->away(config('podcast.spotify_rss_url', 'https://anchor.fm/s/116518364/podcast/rss'));
    }

    /**
     * Generate dynamic XML sitemap for Google Search Console and web crawlers.
     */
    public function sitemap(): Response
    {
        $episodes = $this->repository->getEpisodes();
        $guests = $this->repository->getGuests();
        $themes = $this->repository->getThemes();
        $articles = Article::where('is_published', true)->orderByDesc('published_at')->get();

        $content = view('feed.sitemap', compact('episodes', 'guests', 'themes', 'articles'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }
}
