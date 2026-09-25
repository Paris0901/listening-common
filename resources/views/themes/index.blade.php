@extends('layouts.app')

@section('title', 'Thematic Collections — The Listening Commons')
@section('meta_description', 'Explore conversations categorized by foundational human themes: Mental Health, Human Dignity, Peace, Gender, Culture, and AI.')

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-12">
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">FOUNDATIONAL INQUIRY</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] leading-tight">
                Thematic Collections
            </h1>
            <p class="text-xs sm:text-sm text-zinc-400 mt-3 leading-relaxed">
                Rather than treating podcasts as transient noise, we curate our dialogues into enduring intellectual collections that deepen over time.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($themes as $theme)
            <div class="card-editorial rounded-2xl p-8 flex flex-col justify-between group">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-1 font-mono">THEME &sect;0{{ $loop->iteration }}</span>
                    <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] group-hover:text-[#2DD4BF] transition-colors mb-2">
                        <a href="{{ route('themes.show', $theme->slug) }}">{{ $theme->name }}</a>
                    </h2>
                    <p class="font-serif italic text-xs text-zinc-400 mb-4">{{ $theme->tagline }}</p>
                    <p class="text-xs text-zinc-300 leading-relaxed font-normal mb-6">
                        {{ $theme->description }}
                    </p>
                </div>
                <div class="pt-4 border-t border-[#172346] flex items-center justify-between text-xs font-bold text-zinc-300">
                    <span class="font-mono text-[11px] text-zinc-400">{{ $theme->episodes_count ?? 2 }} Dialogues</span>
                    <a href="{{ route('themes.show', $theme->slug) }}" class="text-[#2DD4BF] hover:text-[#5EEAD4] flex items-center gap-1 font-mono">
                        <span>Explore Collection</span> &rarr;
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
