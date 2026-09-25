@extends('layouts.app')

@section('title', 'Watch Conversations & Filmed Archives — The Listening Commons')
@section('meta_description', 'Watch full filmed studio dialogues, keynote reflections, and curated video archives from The Listening Commons.')

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-12">
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">FILMED ARCHIVE</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] leading-tight">
                Watch The Listening Commons
            </h1>
            <p class="text-xs sm:text-sm text-zinc-400 mt-3 leading-relaxed">
                Full-length studio video recordings and curated topical playlists produced with intellectual care and high-definition audio.
            </p>
        </div>

        <!-- YouTube Playlist Categories Strip -->
        <div class="flex flex-wrap gap-2 mb-12 p-4 card-editorial rounded-xl">
            <span class="text-xs font-bold text-[#2DD4BF] py-1 px-2 font-mono">Curated Playlists:</span>
            <span class="px-3 py-1 rounded-lg bg-[#172346] text-[#2DD4BF] text-xs font-semibold border border-[#2DD4BF]/30">Full Conversations</span>
            <span class="px-3 py-1 rounded-lg bg-[#0C1226] text-zinc-300 text-xs font-medium border border-[#223468]">Mental Health</span>
            <span class="px-3 py-1 rounded-lg bg-[#0C1226] text-zinc-300 text-xs font-medium border border-[#223468]">Women, Peace &amp; Security</span>
            <span class="px-3 py-1 rounded-lg bg-[#0C1226] text-zinc-300 text-xs font-medium border border-[#223468]">AI &amp; Humanity</span>
            <span class="px-3 py-1 rounded-lg bg-[#0C1226] text-zinc-300 text-xs font-medium border border-[#223468]">Responsible Storytelling</span>
            <span class="px-3 py-1 rounded-lg bg-[#0C1226] text-zinc-300 text-xs font-medium border border-[#223468]">Human Dignity</span>
        </div>

        <!-- Video Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach($episodes as $ep)
            <div class="card-editorial rounded-2xl overflow-hidden shadow-xl">
                <div class="aspect-video w-full bg-[#070B16] relative">
                    @if($ep->youtube_id)
                    <iframe 
                        class="w-full h-full"
                        src="https://www.youtube-nocookie.com/embed/{{ $ep->youtube_id }}?rel=0" 
                        title="{{ $ep->title }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between text-xs font-mono text-zinc-400 mb-2">
                        <span class="font-bold text-[#2DD4BF]">EPISODE #{{ $ep->episode_number }}</span>
                        <span>{{ $ep->formatted_duration ?? '50:00' }}</span>
                    </div>
                    <h2 class="font-serif text-xl font-bold text-[#F3EFE6] mb-2 leading-snug">
                        <a href="{{ route('episodes.show', $ep->slug) }}" class="hover:text-[#2DD4BF] transition-colors">{{ $ep->title }}</a>
                    </h2>
                    <p class="text-xs text-zinc-400 line-clamp-2 leading-relaxed mb-4">
                        {{ $ep->short_description }}
                    </p>
                    <div class="flex items-center justify-between text-xs font-semibold pt-3 border-t border-[#172346]">
                        <span class="text-zinc-300">{{ $ep->guest->name ?? 'Guest' }}</span>
                        <a href="{{ route('episodes.show', $ep->slug) }}" class="text-[#2DD4BF] hover:text-[#5EEAD4] font-mono">Full Notes &amp; Transcript &rarr;</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
