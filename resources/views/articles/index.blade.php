@extends('layouts.app')

@section('title', 'Reflections from the Commons — Essays & Written Dispatches')
@section('meta_description', 'Longform essays, clinical commentaries, and philosophical reflections expanding upon dialogues from The Listening Commons.')

@section('content')
<div class="py-10 sm:py-16 lg:py-20 bg-gradient-to-b via-[#080B11] ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="max-w-3xl mb-12 sm:mb-16">
            <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-2 font-semibold">
                WRITTEN DISPATCHES &bull; REFLECTIONS FROM THE COMMONS
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-[3.5rem] font-normal tracking-tight text-[#F4F4F0] leading-[1.14]">
                Essays &amp; Reflections
            </h1>
            <p class="mt-4 font-serif text-sm sm:text-base text-[#94A3B8] max-w-2xl leading-relaxed font-light">
                Longform companion writings, psychiatric reflections, and philosophical dispatches exploring ideas that emerge when conversation is given enough time.
            </p>
        </div>

        <!-- Dynamic Essays Grid (Ingested from Substack) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($articles as $article)
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl overflow-hidden p-6 sm:p-7 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    @if($article->cover_url)
                    <div class="aspect-[16/9] w-full overflow-hidden rounded-xl mb-5 bg-[#090D15] border border-[#1C263A]">
                        <img src="{{ $article->cover_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @endif

                    <div class="flex items-center justify-between text-[11px] font-mono text-[#94A3B8] pb-3 border-b border-[#1C263A]">
                        <span class="text-[#2DD4BF] uppercase font-bold tracking-wider">&sect; {{ $article->theme->name ?? 'Substack Letter' }}</span>
                        <span>{{ $article->reading_time }}</span>
                    </div>

                    <h2 class="font-serif text-xl sm:text-2xl font-medium text-[#F4F4F0] group-hover:text-[#2DD4BF] transition-colors leading-snug mt-4 mb-3 line-clamp-2">
                        <a href="{{ $article->substack_url ?? '#' }}" target="_blank" rel="noopener">
                            {{ $article->title }}
                        </a>
                    </h2>

                    <p class="font-serif italic text-xs sm:text-sm text-[#94A3B8] leading-relaxed line-clamp-3 mb-6 font-light">
                        &ldquo;{{ $article->summary }}&rdquo;
                    </p>
                </div>

                <div class="pt-4 border-t border-[#1C263A] flex items-center justify-between text-xs">
                    <div class="truncate pr-2">
                        <span class="block text-xs font-semibold text-[#F4F4F0] font-sans truncate">{{ $article->author_name }}</span>
                        <span class="block text-[11px] text-[#64748B] font-mono truncate">{{ $article->published_at ? $article->published_at->format('M d, Y') : 'Recent' }}</span>
                    </div>
                    <a href="{{ $article->substack_url ?? '#' }}" target="_blank" rel="noopener" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center gap-1 shrink-0">
                        <span>Read</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16 text-[#94A3B8] font-serif">
                <p>No dispatches found. Running automated sync...</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
