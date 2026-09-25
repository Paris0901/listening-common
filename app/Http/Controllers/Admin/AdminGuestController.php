<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminGuestController extends Controller
{
    public function index(): View
    {
        $guests = Guest::withCount('episodes')->orderBy('name')->get();

        return view('admin.guests.index', compact('guests'));
    }

    public function create(): View
    {
        return view('admin.guests.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Guest::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        Guest::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'designation' => $validated['designation'],
            'affiliation' => $validated['affiliation'],
            'bio' => $validated['bio'],
            'photo_url' => $validated['photo_url'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
            'website_url' => $validated['website_url'],
            'linkedin_url' => $validated['linkedin_url'],
            'twitter_url' => $validated['twitter_url'],
        ]);

        return redirect()->route('admin.guests.index')
            ->with('success', "Guest '{$validated['name']}' added to the Thinkers & Guest Constellation.");
    }

    public function edit(int $id): View
    {
        $guest = Guest::findOrFail($id);

        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $guest = Guest::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'bio' => 'required|string',
            'photo_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        $guest->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'designation' => $validated['designation'],
            'affiliation' => $validated['affiliation'],
            'bio' => $validated['bio'],
            'photo_url' => $validated['photo_url'] ?? $guest->photo_url,
            'website_url' => $validated['website_url'],
            'linkedin_url' => $validated['linkedin_url'],
            'twitter_url' => $validated['twitter_url'],
        ]);

        return redirect()->route('admin.guests.index')
            ->with('success', "Guest '{$guest->name}' profile updated.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $guest = Guest::findOrFail($id);
        $name = $guest->name;
        $guest->delete();

        return redirect()->route('admin.guests.index')
            ->with('success', "Guest '{$name}' removed from directory.");
    }
}
