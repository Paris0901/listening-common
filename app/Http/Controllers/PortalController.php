<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ListeningCommonsRepository;
use Illuminate\View\View;

class PortalController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function watch(): View
    {
        $episodes = $this->repository->getEpisodes();

        return view('watch', compact('episodes'));
    }

    public function listen(): View
    {
        $episodes = $this->repository->getEpisodes();
        $featuredEpisode = $this->repository->getFeaturedEpisode();

        return view('listen', compact('episodes', 'featuredEpisode'));
    }

    public function articles(): View
    {
        $articles = Article::with('theme')->where('is_published', true)->orderByDesc('published_at')->get();

        return view('articles.index', compact('articles'));
    }

    public function about(): View
    {
        $themes = $this->repository->getThemes();

        return view('about', compact('themes'));
    }

    public function newsletter(): View
    {
        $recentLetters = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        return view('newsletter', compact('recentLetters'));
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function press(): View
    {
        return view('press');
    }

    public function collaborations(): View
    {
        return view('collaborations');
    }

    public function editorialPolicy(): View
    {
        return view('policies.editorial');
    }

    public function medicalDisclaimer(): View
    {
        return view('policies.medical');
    }

    public function privacy(): View
    {
        return view('policies.privacy');
    }
}
