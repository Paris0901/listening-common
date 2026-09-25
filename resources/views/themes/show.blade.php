@extends('layouts.app')

@section('title', $theme->name . ' — Thematic Collection | The Listening Commons')
@section('meta_description', $theme->description)

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Theme Header -->
        <div class="card-editorial p-8 sm:p-12 rounded-3xl mb-16 relative overflow-hidden bg-gradient-to-br from-[#0C1226] to-[#070B16]">
            <div class="max-w-3xl relative z-10">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">THEMATIC COLLECTION</span>
                <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] mb-3">{{ $theme->name }}</h1>
                <p class="font-serif italic text-base sm:text-lg text-zinc-300 mb-4">{{ $theme->tagline }}</p>
                <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed font-normal">
                    {{ $theme->description }}
                </p>
            </div>
        </div>

        <!-- Episodes under this theme -->
        <div class="flex items-center justify-between mb-8 border-b border-[#172346] pb-4">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6]">
                Conversations in {{ $theme->name }}
            </h2>
            <span class="text-xs text-zinc-400 font-mono">{{ count($episodes) }} dialogues</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($episodes as $ep)
            <article class="card-editorial p-6 rounded-2xl flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between text-xs font-mono text-zinc-400 mb-3">
                        <span class="font-bold text-[#2DD4BF]">EPISODE #{{ $ep->episode_number }}</span>
                        <span>{{ $ep->formatted_duration ?? '50:00' }}</span>
                    </div>

                    <h3 class="font-serif text-xl font-bold text-[#F3EFE6] group-hover:text-[#2DD4BF] transition-colors mb-2 leading-snug">
                        <a href="{{ route('episodes.show', $ep->slug) }}">{{ $ep->title }}</a>
                    </h3>

                    <p class="text-xs text-zinc-400 line-clamp-3 leading-relaxed mb-6">
                        {{ $ep->short_description }}
                    </p>
                </div>

                <div class="pt-4 border-t border-[#172346] flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-[#F3EFE6]">{{ $ep->guest->name ?? 'Guest' }}</span>
                        <span class="block text-[11px] text-zinc-400">{{ $ep->guest->designation ?? '' }}</span>
                    </div>

                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-[#172346] hover:bg-[#2DD4BF] text-[#2DD4BF] hover:text-[#070B16] flex items-center justify-center transition-colors shadow cursor-pointer active:scale-95"
                        data-title="{{ $ep->title }}"
                        data-guest="{{ $ep->guest->name ?? 'Guest' }}"
                        data-duration="{{ $ep->formatted_duration ?? '50:00' }}"
                        data-cover="{{ $ep->artwork_url }}"
                        data-audio="{{ $ep->audio_url }}">
                        <svg class="w-3.5 h-3.5 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>
            @empty
            <div class="col-span-2 p-8 rounded-2xl card-editorial text-center text-zinc-400">
                <p>No dialogues currently catalogued under this collection.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
