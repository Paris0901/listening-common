<?php

namespace App\Http\Controllers;

use App\Services\ListeningCommonsRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EpisodeController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function index(Request $request): View
    {
        $themeSlug = $request->query('theme');
        $search = $request->query('q');

        $episodes = $this->repository->getEpisodes($themeSlug, $search);
        $themes = $this->repository->getThemes();
        $currentTheme = $themeSlug ? $this->repository->findThemeBySlug($themeSlug) : null;

        return view('episodes.index', compact('episodes', 'themes', 'currentTheme', 'search'));
    }

    public function show(string $slug): View
    {
        $episode = $this->repository->findEpisodeBySlug($slug);

        if (! $episode) {
            abort(404, 'Episode not found');
        }

        $relatedEpisodes = $this->repository->getEpisodes()
            ->filter(fn ($ep) => $ep->slug !== $slug)
            ->take(3);

        return view('episodes.show', compact('episode', 'relatedEpisodes'));
    }
}
