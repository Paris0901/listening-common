<?php

namespace App\Http\Controllers;

use App\Services\ListeningCommonsRepository;
use Illuminate\View\View;

class ThemeController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function index(): View
    {
        $themes = $this->repository->getThemes();

        return view('themes.index', compact('themes'));
    }

    public function show(string $slug): View
    {
        $theme = $this->repository->findThemeBySlug($slug);

        if (! $theme) {
            abort(404, 'Theme not found');
        }

        $episodes = $this->repository->getEpisodes($slug);

        return view('themes.show', compact('theme', 'episodes'));
    }
}
