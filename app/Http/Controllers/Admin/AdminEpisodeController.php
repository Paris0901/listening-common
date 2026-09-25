<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Services\ListeningCommonsRepository;
use App\Services\SpotifyPodcastSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminEpisodeController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function index(): View
    {
        if ($this->repository->isDatabaseReady()) {
            $episodes = Episode::with(['guest', 'themes'])->orderByDesc('episode_number')->get();
        } else {
            $episodes = $this->repository->getEpisodes();
        }

        return view('admin.episodes.index', compact('episodes'));
    }

    public function create(): View
    {
        $guests = $this->repository->getGuests();
        $themes = $this->repository->getThemes();

        return view('admin.episodes.create', compact('guests', 'themes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'episode_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'guest_id' => 'required',
            'host_names' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'full_show_notes' => 'required|string',
            'artwork_url' => 'nullable|url',
            'audio_url' => 'required|url',
            'audio_duration_seconds' => 'nullable|integer',
            'youtube_url' => 'nullable|url',
            'spotify_url' => 'nullable|url',
            'apple_podcasts_url' => 'nullable|url',
            'amazon_music_url' => 'nullable|url',
            'transcript' => 'nullable|string',
            'key_quotations_raw' => 'nullable|string',
            'relevant_links_raw' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'published_at' => 'nullable|date',
            'themes' => 'nullable|array',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['title']);

        // Process key quotations JSON
        $quotes = [];
        if (! empty($validated['key_quotations_raw'])) {
            $lines = explode("\n", trim($validated['key_quotations_raw']));
            foreach ($lines as $line) {
                if (trim($line)) {
                    $quotes[] = ['quote' => trim($line), 'speaker' => 'Featured Thinker'];
                }
            }
        }

        // Process relevant links JSON
        $links = [];
        if (! empty($validated['relevant_links_raw'])) {
            $lines = explode("\n", trim($validated['relevant_links_raw']));
            foreach ($lines as $line) {
                if (trim($line)) {
                    $links[] = ['label' => trim($line), 'url' => trim($line)];
                }
            }
        }

        if ($this->repository->isDatabaseReady()) {
            $episode = Episode::create([
                'episode_number' => $validated['episode_number'],
                'title' => $validated['title'],
                'slug' => $slug,
                'guest_id' => $validated['guest_id'],
                'host_names' => $validated['host_names'] ?? 'Scott Douglas Jacobsen & Dr. Aninda Sidhana',
                'short_description' => $validated['short_description'],
                'full_show_notes' => $validated['full_show_notes'],
                'artwork_url' => $validated['artwork_url'] ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
                'audio_url' => $validated['audio_url'],
                'audio_duration_seconds' => $validated['audio_duration_seconds'] ?? 3600,
                'youtube_url' => $validated['youtube_url'],
                'spotify_url' => $validated['spotify_url'] ?? null,
                'apple_podcasts_url' => $validated['apple_podcasts_url'] ?? null,
                'amazon_music_url' => $validated['amazon_music_url'] ?? null,
                'transcript' => $validated['transcript'],
                'key_quotations' => $quotes,
                'relevant_links' => $links,
                'seo_title' => $validated['seo_title'] ?? $validated['title'].' | The Listening Commons',
                'meta_description' => $validated['meta_description'] ?? $validated['short_description'],
                'keywords' => $validated['keywords'],
                'published_at' => $validated['published_at'] ?? now(),
                'is_published' => $request->has('is_published'),
                'is_featured' => $request->has('is_featured'),
            ]);

            if (! empty($validated['themes'])) {
                $episode->themes()->sync($validated['themes']);
            }
        }

        return redirect()->route('admin.episodes.index')
            ->with('success', "Master Episode #{$validated['episode_number']} published successfully!");
    }

    public function edit(int $id): View
    {
        $episode = Episode::with(['guest', 'themes'])->findOrFail($id);
        $guests = $this->repository->getGuests();
        $themes = $this->repository->getThemes();

        return view('admin.episodes.edit', compact('episode', 'guests', 'themes'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $episode = Episode::findOrFail($id);

        $validated = $request->validate([
            'episode_number' => 'required|integer',
            'title' => 'required|string|max:255',
            'guest_id' => 'required',
            'host_names' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'full_show_notes' => 'required|string',
            'artwork_url' => 'nullable|url',
            'audio_url' => 'required|url',
            'audio_duration_seconds' => 'nullable|integer',
            'youtube_url' => 'nullable|url',
            'spotify_url' => 'nullable|url',
            'apple_podcasts_url' => 'nullable|url',
            'amazon_music_url' => 'nullable|url',
            'transcript' => 'nullable|string',
            'key_quotations_raw' => 'nullable|string',
            'relevant_links_raw' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'published_at' => 'nullable|date',
            'themes' => 'nullable|array',
        ]);

        $quotes = [];
        if (! empty($validated['key_quotations_raw'])) {
            $lines = explode("\n", trim($validated['key_quotations_raw']));
            foreach ($lines as $line) {
                if (trim($line)) {
                    $quotes[] = ['quote' => trim($line), 'speaker' => 'Featured Thinker'];
                }
            }
        }

        $links = [];
        if (! empty($validated['relevant_links_raw'])) {
            $lines = explode("\n", trim($validated['relevant_links_raw']));
            foreach ($lines as $line) {
                if (trim($line)) {
                    $links[] = ['label' => trim($line), 'url' => trim($line)];
                }
            }
        }

        $episode->update([
            'episode_number' => $validated['episode_number'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'guest_id' => $validated['guest_id'],
            'host_names' => $validated['host_names'] ?? 'Scott Douglas Jacobsen & Dr. Aninda Sidhana',
            'short_description' => $validated['short_description'],
            'full_show_notes' => $validated['full_show_notes'],
            'artwork_url' => $validated['artwork_url'] ?? $episode->artwork_url,
            'audio_url' => $validated['audio_url'],
            'audio_duration_seconds' => $validated['audio_duration_seconds'] ?? $episode->audio_duration_seconds,
            'youtube_url' => $validated['youtube_url'],
            'spotify_url' => $validated['spotify_url'] ?? null,
            'apple_podcasts_url' => $validated['apple_podcasts_url'] ?? null,
            'amazon_music_url' => $validated['amazon_music_url'] ?? null,
            'transcript' => $validated['transcript'],
            'key_quotations' => ! empty($quotes) ? $quotes : $episode->key_quotations,
            'relevant_links' => ! empty($links) ? $links : $episode->relevant_links,
            'seo_title' => $validated['seo_title'] ?? $episode->seo_title,
            'meta_description' => $validated['meta_description'] ?? $episode->meta_description,
            'keywords' => $validated['keywords'],
            'published_at' => $validated['published_at'] ?? $episode->published_at,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if (isset($validated['themes'])) {
            $episode->themes()->sync($validated['themes']);
        }

        return redirect()->route('admin.episodes.index')
            ->with('success', "Master Episode #{$episode->episode_number} updated successfully.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $episode = Episode::findOrFail($id);
        $num = $episode->episode_number;
        $episode->delete();

        return redirect()->route('admin.episodes.index')
            ->with('success', "Episode #{$num} was removed from the library.");
    }

    public function syncSpotify(Request $request, SpotifyPodcastSyncService $syncService): RedirectResponse
    {
        $customUrl = $request->input('spotify_rss_url');

        $result = $syncService->sync($customUrl);

        if (! $result['success']) {
            return redirect()->route('admin.episodes.index')
                ->with('error', $result['message']);
        }

        return redirect()->route('admin.episodes.index')
            ->with('success', $result['message']);
    }
}
