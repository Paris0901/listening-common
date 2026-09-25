<?php

namespace App\Http\Controllers;

use App\Services\ListeningCommonsRepository;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function __construct(
        protected ListeningCommonsRepository $repository
    ) {}

    public function index(): View
    {
        $guests = $this->repository->getGuests();

        return view('guests.index', compact('guests'));
    }

    public function show(string $slug): View
    {
        $guest = $this->repository->findGuestBySlug($slug);

        if (! $guest) {
            abort(404, 'Guest profile not found');
        }

        $episodes = $this->repository->getEpisodes()
            ->filter(fn ($ep) => ($ep->guest->slug ?? '') === $slug);

        return view('guests.show', compact('guest', 'episodes'));
    }
}
