<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Episode;
use App\Models\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::with(['theme', 'episode'])
            ->orderByDesc('published_at')
            ->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $themes = Theme::orderBy('name')->get();
        $episodes = Episode::orderByDesc('episode_number')->get();

        return view('admin.articles.create', compact('themes', 'episodes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'theme_id' => 'nullable|exists:themes,id',
            'episode_id' => 'nullable|exists:episodes,id',
            'summary' => 'required|string|max:1000',
            'body' => 'required|string',
            'cover_url' => 'nullable|url',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = Str::slug($validated['title']);

        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'author_name' => $validated['author_name'],
            'theme_id' => $validated['theme_id'] ?? null,
            'episode_id' => $validated['episode_id'] ?? null,
            'summary' => $validated['summary'],
            'body' => $validated['body'],
            'cover_url' => $validated['cover_url'] ?? 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1200&q=80',
            'published_at' => $validated['published_at'] ?? now(),
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', "Essay '{$validated['title']}' saved to Reflections & Essays.");
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        $themes = Theme::orderBy('name')->get();
        $episodes = Episode::orderByDesc('episode_number')->get();

        return view('admin.articles.edit', compact('article', 'themes', 'episodes'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'theme_id' => 'nullable|exists:themes,id',
            'episode_id' => 'nullable|exists:episodes,id',
            'summary' => 'required|string|max:1000',
            'body' => 'required|string',
            'cover_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        $article->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'author_name' => $validated['author_name'],
            'theme_id' => $validated['theme_id'] ?? null,
            'episode_id' => $validated['episode_id'] ?? null,
            'summary' => $validated['summary'],
            'body' => $validated['body'],
            'cover_url' => $validated['cover_url'] ?? $article->cover_url,
            'published_at' => $validated['published_at'] ?? $article->published_at,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', "Essay '{$article->title}' updated successfully.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $title = $article->title;
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', "Essay '{$title}' removed from publication.");
    }
}
