@extends('layouts.app')

@section('title', 'Conversations & Broadcasts Archive — The Listening Commons')
@section('meta_description', 'Explore all conversations and broadcasts of The Listening Commons. Recorded with unhurried rigor across Mental Health, Human Dignity, Peace, Gender, Culture, AI, and Lived Experience.')

@section('content')
<div class="py-10 sm:py-16 lg:py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Archive Header -->
        <div class="max-w-3xl mb-10 sm:mb-12">
            <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#7fe3df] block mb-2 font-semibold">
                COMPLETE ARCHIVE
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-[3.5rem] font-normal tracking-tight text-[#fdf8f6] leading-[1.14]">
                Conversations &amp; Broadcasts
            </h1>
            <div class="h-0.5 w-16 mt-4 mb-4 rounded-full bg-gradient-to-r from-[#1fb8b8] to-[#ef6b9c]"></div>
            <p class="font-serif text-sm sm:text-base text-[#9a93a3] max-w-2xl leading-relaxed font-light">
                Every dialogue on The Listening Commons is recorded with unhurried rigor, transcribed verbatim, and preserved as part of our searchable knowledge commons.
            </p>
        </div>

        <!-- Filter & Search Control Panel -->
        <div class="rounded-2xl bg-[#0f2230]/80 backdrop-blur-md border border-[rgba(253,248,246,0.12)] mb-10 sm:mb-14 p-5 sm:p-7 shadow-2xl space-y-5 sm:space-y-6">
            <!-- Top Tier: Full-Width Search Input + Counter -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                <form action="{{ route('episodes.index') }}" method="GET" class="flex-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    @if(!empty($currentTheme))
                        <input type="hidden" name="theme" value="{{ $currentTheme->slug }}">
                    @endif
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#9a93a3]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="q" value="{{ $search ?? '' }}" 
                            placeholder="Search by speaker, topic, or transcript keyword..." 
                            class="w-full pl-11 pr-4 py-3 rounded-xl bg-[#0a1620] border border-[rgba(253,248,246,0.12)] text-xs sm:text-sm text-[#fdf8f6] placeholder-[#9a93a3] focus:outline-none focus:border-[#1fb8b8] focus:ring-1 focus:ring-[#1fb8b8] font-sans transition-all">
                        @if($search)
                            <a href="{{ route('episodes.index', array_filter(['theme' => $currentTheme->slug ?? null])) }}" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#9a93a3] hover:text-[#fdf8f6]" title="Clear search">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                    <button type="submit" class="btn-grad px-6 py-3 rounded-xl font-sans font-semibold text-xs uppercase tracking-widest text-white transition-all cursor-pointer shadow-md text-center shrink-0">
                        Search Archive
                    </button>
                </form>
            </div>
        </div>

        <!-- 3-Column Episodes Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($episodes as $ep)
            <article class="card-editorial rounded-2xl overflow-hidden flex flex-col justify-between group shadow-xl">
                <!-- Card Header Image / Artwork Banner -->
                <div class="aspect-[16/10] w-full relative overflow-hidden bg-[#070d17]">
                    <img src="{{ $ep->artwork_url }}" alt="{{ $ep->title }}" class="w-full h-full object-cover contrast-125 opacity-90 group-hover:scale-105 group-hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2230] via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between text-xs font-mono">
                        <span class="px-2.5 py-1 rounded bg-[#0a1620]/90 text-[#7fe3df] font-bold border border-[rgba(253,248,246,0.12)] tracking-wider uppercase">
                            EP. {{ $ep->episode_number }}
                        </span>
                        <span class="px-2.5 py-1 rounded bg-[#0f2230]/90 text-[#fdf8f6] border border-[rgba(253,248,246,0.12)] tracking-wider">
                            {{ $ep->formatted_duration ?? '57:00' }}
                        </span>
                    </div>
                </div>

                <!-- Content Body -->
                <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <!-- Themes tags -->
                        <div class="flex flex-wrap gap-1.5 mb-3.5">
                            @foreach($ep->themes ?? [] as $th)
                            <a href="{{ route('episodes.index', ['theme' => $th->slug]) }}" class="px-2.5 py-0.5 rounded-full text-[10px] font-mono tracking-wide uppercase bg-[#0f2230] text-[#7fe3df] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-colors">
                                {{ $th->name }}
                            </a>
                            @endforeach
                        </div>

                        <h2 class="font-serif text-xl sm:text-2xl font-medium text-[#fdf8f6] group-hover:text-[#7fe3df] transition-colors leading-snug mb-3">
                            <a href="{{ route('episodes.show', $ep->slug) }}">{{ $ep->title }}</a>
                        </h2>

                        <p class="font-serif italic text-xs sm:text-sm text-[#9a93a3] leading-relaxed line-clamp-3 mb-6 font-light">
                            {{ $ep->short_description }}
                        </p>
                    </div>

                    <!-- Footer Guest / Play Bar -->
                    <div class="pt-4 border-t border-[rgba(253,248,246,0.1)] flex items-center justify-between mt-auto">
                        <div class="truncate pr-3">
                            <span class="block text-xs font-semibold text-[#fdf8f6] uppercase tracking-wider truncate font-sans">{{ $ep->guest->name ?? 'Guest' }}</span>
                            <span class="block text-[11px] text-[#9a93a3] truncate font-sans">{{ $ep->guest->designation ?? '' }}</span>
                        </div>

                        <button type="button" aria-label="Play Episode {{ $ep->episode_number }}" class="play-track-btn w-9 h-9 rounded-full bg-[#0f2230] border border-[rgba(253,248,246,0.15)] text-[#fdf8f6] group-hover:bg-gradient-to-r group-hover:from-[#1fb8b8] group-hover:to-[#ef6b9c] group-hover:border-transparent group-hover:text-white group-hover:shadow-[0_0_15px_rgba(239,107,156,0.4)] flex items-center justify-center shrink-0 transition-all shadow cursor-pointer active:scale-95"
                            data-title="{{ $ep->title }}"
                            data-guest="{{ $ep->guest->name ?? 'Guest' }}"
                            data-duration="{{ $ep->formatted_duration ?? '57:00' }}"
                            data-cover="{{ $ep->artwork_url }}"
                            data-audio="{{ $ep->audio_url }}">
                            <svg class="w-3.5 h-3.5 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16 bg-[#0f2230]/80 border border-[rgba(253,248,246,0.12)] rounded-2xl p-8">
                <p class="font-serif text-lg text-[#9a93a3]">No conversations found matching your search query.</p>
                <a href="{{ route('episodes.index') }}" class="inline-block mt-4 text-xs font-semibold uppercase tracking-wider text-[#7fe3df] hover:underline font-mono">
                    Clear Filters &rarr;
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
