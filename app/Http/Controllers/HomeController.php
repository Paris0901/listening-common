<?php

namespace App\Http\Controllers;

use App\Services\ListeningCommonsRepository;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function __invoke(): View
    {
        $featuredEpisode = $this->repository->getFeaturedEpisode();
        $latestEpisodes = $this->repository->getEpisodes();
        $themes = $this->repository->getThemes();
        $guests = $this->repository->getGuests();

        return view('home', compact('featuredEpisode', 'latestEpisodes', 'themes', 'guests'));
    }
}
