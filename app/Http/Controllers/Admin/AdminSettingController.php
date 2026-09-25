<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Episode;
use App\Models\Setting;
use App\Services\SpotifyPodcastSyncService;
use App\Services\SubstackNewsletterSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSettingController extends Controller
{
    /**
     * Display the simplified Typography & Font Selection page.
     */
    public function typography(): View
    {
        $currentPreset = Setting::get('site_font_preset', 'editorial');
        $episodesCount = Episode::count();
        $articlesCount = Article::count();

        $presets = [
            'editorial' => [
                'name' => 'Editorial Sanctuary (Recommended)',
                'badge' => 'Classic & Intellectual',
                'serif' => "'Newsreader', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
                'description' => 'Warm, distinguished editorial serif paired with classical Roman titles. Ideal for philosophical depth.',
                'sample' => '“We listen not to defeat an opponent, but to uncover the sacred ground between us.”',
            ],
            'literary' => [
                'name' => 'Literary Renaissance',
                'badge' => 'Graceful & Bookish',
                'serif' => "'Cormorant Garamond', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Inter', sans-serif",
                'description' => 'Timeless Roman elegance reminiscent of historical publishing houses and museum archives.',
                'sample' => '“Moving mental health beyond clinical walls and into public consciousness.”',
            ],
            'scholarly' => [
                'name' => 'Scholarly Archival',
                'badge' => 'Authoritative Journal',
                'serif' => "'Playfair Display', Georgia, serif",
                'display' => "'Playfair Display', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
                'description' => 'High-contrast editorial serif echoing premier literary and investigative journalism publications.',
                'sample' => '“Restoring human dignity where diagnostic labels fell short.”',
            ],
            'warm' => [
                'name' => 'Warm Humanities',
                'badge' => 'Inviting & Lyrical',
                'serif' => "'Lora', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
                'description' => 'Gentle contemporary serif with calligraphic curves designed for sustained, comfortable reading.',
                'sample' => '“Conversations exploring trauma, healing, and lived experience.”',
            ],
            'modern' => [
                'name' => 'Modern Minimalist',
                'badge' => 'Contemporary Clarity',
                'serif' => "'Plus Jakarta Sans', ui-sans-serif, sans-serif",
                'display' => "'Plus Jakarta Sans', sans-serif",
                'sans' => "'Inter', sans-serif",
                'description' => 'Clean, sleek, sans-serif aesthetic with exceptional digital legibility across all screens.',
                'sample' => '“Independent digital publishing hub dedicated to human dignity and dialogue.”',
            ],
        ];

        return view('admin.settings.typography', compact('currentPreset', 'presets', 'episodesCount', 'articlesCount'));
    }

    /**
     * Update the active typography preset.
     */
    public function updateTypography(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'preset' => ['required', 'string', 'in:editorial,literary,scholarly,warm,modern'],
        ]);

        Setting::set('site_font_preset', $validated['preset'], 'Primary Website Typography Preset');

        return redirect()->route('admin.settings.typography')
            ->with('success', 'Website font styling updated successfully! Changes are live across the portal.');
    }

    /**
     * 1-Click quick sync for Spotify podcasts.
     */
    public function syncSpotify(SpotifyPodcastSyncService $syncService): RedirectResponse
    {
        $result = $syncService->sync();

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * 1-Click quick sync for Substack newsletters.
     */
    public function syncSubstack(SubstackNewsletterSyncService $syncService): RedirectResponse
    {
        $result = $syncService->syncAll();

        if ($result['success']) {
            return back()->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}
