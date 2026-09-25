@extends('layouts.app')

@section('title', 'Listen & Subscribe — The Listening Commons')
@section('meta_description', 'Subscribe to The Listening Commons on Spotify, Apple Podcasts, Amazon Music, YouTube, and RSS.')

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-12">
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">PODCAST DISTRIBUTION</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] leading-tight">
                Listen Across Supported Directories
            </h1>
            <p class="text-xs sm:text-sm text-zinc-400 mt-3 leading-relaxed">
                The Listening Commons syndicates via a canonical RSS 2.0 feed to all major podcast players. Subscribe on your preferred listening client or stream directly in uncompressed fidelity.
            </p>
        </div>

        <!-- Directory Buttons Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-16">
            <!-- Spotify -->
            <a href="https://open.spotify.com/show/listeningcommons" target="_blank" rel="noopener" class="card-editorial p-5 rounded-2xl text-center group">
                <div class="w-10 h-10 rounded-full bg-[#1DB954]/15 text-[#1DB954] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm4.586 14.424c-.18.295-.563.387-.857.207-2.35-1.436-5.308-1.76-8.793-.963-.335.077-.67-.133-.746-.468-.077-.334.132-.67.467-.746 3.808-.87 7.076-.496 9.722 1.12.294.18.386.563.207.85zM17.81 13.7c-.227.37-.711.488-1.08.26-2.69-1.654-6.79-2.133-9.972-1.168-.418.127-.864-.112-.991-.53-.127-.418.112-.864.53-.991 3.632-1.102 8.147-.568 11.253 1.348.37.228.488.712.26 1.081zm.156-2.829c-3.226-1.916-8.544-2.093-11.623-1.158-.495.15-1.022-.129-1.172-.624-.15-.495.13-1.022.624-1.172 3.535-1.073 9.404-.866 13.115 1.338.445.264.59.838.327 1.282-.264.444-.838.59-1.27.334z"/></svg>
                </div>
                <span class="font-bold text-xs text-[#F3EFE6] mb-1 block">Spotify</span>
                <span class="text-[10px] text-zinc-400 uppercase tracking-wider font-mono">Listen &bull; Free</span>
            </a>

            <!-- Apple Podcasts -->
            <a href="https://podcasts.apple.com/podcast/the-listening-commons" target="_blank" rel="noopener" class="card-editorial p-5 rounded-2xl text-center group">
                <div class="w-10 h-10 rounded-full bg-[#A355EC]/15 text-[#A355EC] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.38c.62-.75 1.04-1.8 0.92-2.85-.9.04-1.98.6-2.62 1.34-.56.64-1.05 1.69-.92 2.71 1 .08 2-.45 2.62-1.2z"/></svg>
                </div>
                <span class="font-bold text-xs text-[#F3EFE6] mb-1 block">Apple Podcasts</span>
                <span class="text-[10px] text-zinc-400 uppercase tracking-wider font-mono">Listen &bull; iOS</span>
            </a>

            <!-- Amazon Music -->
            <a href="https://music.amazon.com" target="_blank" rel="noopener" class="card-editorial p-5 rounded-2xl text-center group">
                <div class="w-10 h-10 rounded-full bg-[#00A8E1]/15 text-[#00A8E1] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 14.5c-2.49 0-4.5-2.01-4.5-4.5S9.51 7.5 12 7.5s4.5 2.01 4.5 4.5-2.01 4.5-4.5 4.5z"/></svg>
                </div>
                <span class="font-bold text-xs text-[#F3EFE6] mb-1 block">Amazon Music</span>
                <span class="text-[10px] text-zinc-400 uppercase tracking-wider font-mono">Listen &bull; Prime</span>
            </a>

            <!-- YouTube Music -->
            <a href="https://music.youtube.com" target="_blank" rel="noopener" class="card-editorial p-5 rounded-2xl text-center group">
                <div class="w-10 h-10 rounded-full bg-[#FF0000]/15 text-[#FF0000] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
                </div>
                <span class="font-bold text-xs text-[#F3EFE6] mb-1 block">YouTube</span>
                <span class="text-[10px] text-zinc-400 uppercase tracking-wider font-mono">Audio &bull; Video</span>
            </a>

            <!-- Direct RSS -->
            <div onclick="navigator.clipboard.writeText('{{ route('feed.podcast') }}'); alert('Podcast RSS Feed copied: {{ route('feed.podcast') }}');" class="card-editorial p-5 rounded-2xl text-center group cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-[#2DD4BF]/15 text-[#2DD4BF] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M6.503 20.752c0 1.794-1.456 3.248-3.251 3.248-1.796 0-3.252-1.454-3.252-3.248 0-1.794 1.456-3.248 3.252-3.248 1.795 0 3.251 1.454 3.251 3.248zm-6.503-12.572v4.836c6.471 0 11.733 5.26 11.733 11.736h4.842c0-9.141-7.433-16.572-16.575-16.572zm0-8.18v4.841c10.982 0 19.911 8.93 19.911 19.911h4.839c0-13.649-11.1-24.752-24.75-24.752z"/></svg>
                </div>
                <span class="font-bold text-xs text-[#F3EFE6] mb-1 block">Podcast RSS</span>
                <span class="text-[10px] text-[#2DD4BF] uppercase tracking-wider font-mono">Copy XML URL</span>
            </div>
        </div>

        <!-- Featured Player -->
        @if($featuredEpisode)
        <div class="card-editorial p-8 rounded-3xl mb-14">
            <span class="text-[10px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">LATEST RELEASE &bull; EPISODE #{{ $featuredEpisode->episode_number }}</span>
            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#F3EFE6] mb-3">
                <a href="{{ route('episodes.show', $featuredEpisode->slug) }}" class="hover:text-[#2DD4BF] transition-colors">
                    {{ $featuredEpisode->title }}
                </a>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-300 leading-relaxed mb-6">
                {{ $featuredEpisode->short_description }}
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <button type="button" class="play-track-btn inline-flex items-center gap-2.5 px-6 py-3 rounded-lg font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] hover:brightness-110 text-[#070B16] shadow-lg shadow-[#2DD4BF]/25 transition-all cursor-pointer"
                    data-title="{{ $featuredEpisode->title }}"
                    data-guest="{{ $featuredEpisode->guest->name ?? 'Guest' }}"
                    data-duration="{{ $featuredEpisode->formatted_duration ?? '58:00' }}"
                    data-cover="{{ $featuredEpisode->artwork_url }}"
                    data-audio="{{ $featuredEpisode->audio_url }}">
                    <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <span>Play Master Audio</span>
                </button>
                <a href="{{ route('episodes.show', $featuredEpisode->slug) }}" class="px-5 py-3 rounded-lg text-xs font-semibold text-[#F3EFE6] bg-[#070B16] hover:bg-[#111A33] border border-[#223468] transition-colors">
                    Transcript &amp; Show Notes &rarr;
                </a>
            </div>
        </div>
        @endif

        <!-- Recent Broadcasts List -->
        <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-6 border-b border-[#172346] pb-3">
            Recent Broadcasts &bull; Audio Stream
        </h2>
        <div class="space-y-4">
            @foreach($episodes as $ep)
            <div class="card-editorial p-5 rounded-xl flex items-center justify-between gap-4">
                <div class="flex items-center gap-4 truncate">
                    <span class="font-mono text-xs font-bold text-[#2DD4BF]">#0{{ $ep->episode_number }}</span>
                    <div class="truncate">
                        <h3 class="font-serif text-base font-bold text-[#F3EFE6] truncate hover:text-[#2DD4BF]">
                            <a href="{{ route('episodes.show', $ep->slug) }}">{{ $ep->title }}</a>
                        </h3>
                        <p class="text-xs text-zinc-400 truncate">{{ $ep->guest->name ?? 'Guest' }} &bull; {{ $ep->formatted_duration ?? '50:00' }}</p>
                    </div>
                </div>
                <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-[#172346] hover:bg-[#2DD4BF] text-[#2DD4BF] hover:text-[#070B16] flex items-center justify-center shrink-0 transition-colors shadow cursor-pointer active:scale-95"
                    data-title="{{ $ep->title }}"
                    data-guest="{{ $ep->guest->name ?? 'Guest' }}"
                    data-duration="{{ $ep->formatted_duration ?? '50:00' }}"
                    data-cover="{{ $ep->artwork_url }}"
                    data-audio="{{ $ep->audio_url }}">
                    <svg class="w-3.5 h-3.5 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
