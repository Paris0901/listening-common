@extends('layouts.admin')

@section('title', 'Master Episodes CMS')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
        <span class="text-[10px] font-mono uppercase tracking-widest text-[#2DD4BF] block mb-1">CANONICAL EPISODES ARCHIVE</span>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Master Conversations Library</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 max-w-2xl">
            Single-source publishing: episodes created here automatically populate the canonical website, RSS 2.0 podcast feed, XML sitemap, and multi-channel safety distribution queue.
        </p>
    </div>

    <div class="flex items-center gap-3 shrink-0 flex-wrap">
        <button type="button" onclick="document.getElementById('spotify-sync-panel').classList.toggle('hidden');" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-lg bg-[#121A2B] border border-[#1DB954]/40 hover:border-[#1DB954] text-[#1DB954] hover:bg-[#1DB954]/10 text-xs font-mono font-medium transition-all shadow-sm cursor-pointer" title="Configure and trigger Spotify RSS ingestion">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
            </svg>
            <span>Sync from Spotify</span>
        </button>

        <a href="{{ route('admin.episodes.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] text-xs font-mono font-bold uppercase tracking-wider hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 shrink-0 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Conversation</span>
        </a>
    </div>
</div>

<!-- Spotify RSS Sync Engine Panel (Toggleable / Configurable) -->
<div id="spotify-sync-panel" class="mb-8 p-5 sm:p-6 rounded-xl bg-[#0E1626] border border-[#1DB954]/40 shadow-xl relative overflow-hidden">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="max-w-xl">
            <div class="flex items-center gap-2.5 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#1DB954] shadow-[0_0_8px_#1DB954]"></span>
                <span class="text-[11px] font-mono font-semibold uppercase tracking-wider text-[#1DB954]">
                    Spotify for Creators &bull; Automated RSS Engine
                </span>
            </div>
            <h3 class="font-serif text-lg font-medium text-[#F4F4F0]">Single Source of Truth: Spotify RSS Sync</h3>
            <p class="text-xs text-[#94A3B8] leading-relaxed mt-1">
                When new episodes are published on Spotify, this engine imports high-resolution artwork, audio CDN streams, show notes, and duration directly into the website database.
            </p>
            <div class="mt-3 flex flex-wrap items-center gap-4 text-[11px] font-mono text-[#64748B]">
                <span class="text-emerald-400">&bull; Auto-sync: Scheduled Hourly</span>
                <span>&bull; Target Distribution: Apple &bull; Amazon &bull; YouTube Music</span>
            </div>
        </div>

        <!-- Sync Form with Feed URL Input -->
        <form action="{{ route('admin.episodes.sync_spotify') }}" method="POST" class="flex-1 max-w-lg space-y-2.5">
            @csrf
            <label for="spotify_rss_url" class="block text-[11px] font-mono uppercase tracking-wider text-[#94A3B8]">
                Spotify/Anchor RSS Feed URL:
            </label>
            <div class="flex items-center gap-2">
                <input 
                    type="url" 
                    id="spotify_rss_url" 
                    name="spotify_rss_url" 
                    value="{{ config('podcast.spotify_rss_url') }}" 
                    placeholder="https://anchor.fm/s/xxxxx/podcast/rss" 
                    class="flex-1 px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#1C263A] focus:border-[#1DB954] text-xs font-mono text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none"
                    required
                >
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#1DB954] hover:bg-[#1ed760] text-[#080B11] font-mono font-bold text-xs uppercase tracking-wider transition-all shadow-md shrink-0 cursor-pointer flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Sync Now</span>
                </button>
            </div>
            <span class="text-[10px] text-[#64748B] font-mono block">
                Found in Spotify for Creators &rarr; Settings &rarr; Podcast Availability &rarr; RSS Feed.
            </span>
        </form>
    </div>
</div>

<div class="bg-[#0C1220] border border-[#1C263A] rounded-xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-[#F4F4F0]">
            <thead class="bg-[#06080D] border-b border-[#1C263A] text-[11px] font-mono font-medium uppercase tracking-wider text-[#8E9BB0]">
                <tr>
                    <th class="py-3.5 px-5">Ep #</th>
                    <th class="py-3.5 px-5">Title &amp; Route</th>
                    <th class="py-3.5 px-5">Featured Thinker</th>
                    <th class="py-3.5 px-5">Hosts</th>
                    <th class="py-3.5 px-5">Duration</th>
                    <th class="py-3.5 px-5">Status</th>
                    <th class="py-3.5 px-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1C263A]/70">
                @forelse($episodes as $ep)
                <tr class="hover:bg-[#121A2B]/50 transition-colors">
                    <td class="py-4 px-5 font-mono font-bold text-[#2DD4BF] text-sm">
                        #{{ $ep->episode_number }}
                    </td>
                    <td class="py-4 px-5 max-w-xs">
                        <span class="font-display font-medium text-sm block truncate text-[#F4F4F0]">{{ $ep->title }}</span>
                        <span class="text-[11px] text-[#8E9BB0] font-mono">/episodes/{{ $ep->slug }}</span>
                    </td>
                    <td class="py-4 px-5">
                        <span class="font-medium block text-[#F4F4F0]">{{ $ep->guest->name ?? 'Guest Thinker' }}</span>
                        <span class="text-[11px] text-[#8E9BB0] truncate block max-w-[200px]">{{ $ep->guest->designation ?? '' }}</span>
                    </td>
                    <td class="py-4 px-5 text-[#8E9BB0] text-[11px] max-w-[160px] truncate">
                        {{ $ep->host_names ?? 'Scott Douglas Jacobsen' }}
                    </td>
                    <td class="py-4 px-5 font-mono text-[#8E9BB0]">
                        {{ $ep->formatted_duration ?? (isset($ep->audio_duration_seconds) ? gmdate('i:s', $ep->audio_duration_seconds) : '55:00') }}
                    </td>
                    <td class="py-4 px-5">
                        @if($ep->is_published ?? true)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium uppercase tracking-wider bg-emerald-950/70 text-emerald-300 border border-emerald-800/50">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Live &amp; RSS
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium uppercase tracking-wider bg-amber-950/70 text-amber-300 border border-amber-800/50">
                            Draft
                        </span>
                        @endif

                        @if(!empty($ep->spotify_guid))
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-mono uppercase bg-[#1DB954]/20 text-[#1DB954] border border-[#1DB954]/40 mt-1 block w-max">
                            <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                            <span>Spotify CDN</span>
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-5 text-right font-mono space-x-3 whitespace-nowrap">
                        <a href="{{ route('episodes.show', $ep->slug) }}" target="_blank" class="text-xs text-[#2DD4BF] hover:underline inline-flex items-center gap-1">
                            <span>Preview</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>

                        @if(isset($ep->id) && is_numeric($ep->id))
                        <a href="{{ route('admin.episodes.edit', $ep->id) }}" class="text-xs text-[#C5CEE0] hover:text-[#2DD4BF]">
                            Edit
                        </a>

                        <form action="{{ route('admin.episodes.destroy', $ep->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove Episode #{{ $ep->episode_number }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400/80 hover:text-red-400 cursor-pointer">
                                Delete
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-zinc-500 font-mono">
                        No episodes recorded yet. Click "+ New Conversation" to add your first episode.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
