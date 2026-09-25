@extends('layouts.app')

@section('title', $episode->seo_title ?? ($episode->title . ' — The Listening Commons'))
@section('meta_description', $episode->meta_description ?? $episode->short_description)
@section('keywords', $episode->keywords ?? 'podcast, deep listening, human dignity, psychiatry, peacebuilding')
@section('canonical', url('/episodes/' . $episode->slug))
@section('og_image', $episode->artwork_url)

@section('schema')
<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org",
  "{{ '@type' }}": "PodcastEpisode",
  "name": "{{ addslashes($episode->title) }}",
  "description": "{{ addslashes($episode->short_description) }}",
  "url": "{{ url('/episodes/' . $episode->slug) }}",
  "episodeNumber": "{{ $episode->episode_number }}",
  "datePublished": "{{ $episode->published_at ? $episode->published_at->toIso8601String() : now()->toIso8601String() }}",
  "duration": "PT{{ floor(($episode->audio_duration_seconds ?? 3600) / 60) }}M",
  "image": "{{ $episode->artwork_url }}",
  "actor": {
    "{{ '@type' }}": "Person",
    "name": "{{ addslashes($episode->guest->name ?? 'Guest') }}"
  },
  "director": {
    "{{ '@type' }}": "Person",
    "name": "{{ addslashes($episode->host_names ?? 'Scott Douglas Jacobsen') }}"
  },
  "partOfSeries": {
    "{{ '@type' }}": "PodcastSeries",
    "name": "The Listening Commons",
    "url": "{{ url('/') }}"
  }
}
</script>
@endsection

@section('content')
<article class="py-12 lg:py-20 relative z-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-medium text-[#9a93a3] mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#7fe3df] transition-colors">The Commons</a>
            <span>&bull;</span>
            <a href="{{ route('episodes.index') }}" class="hover:text-[#7fe3df] transition-colors">Conversations</a>
            <span>&bull;</span>
            <span class="text-[#7fe3df] font-mono font-semibold truncate">Ep. {{ $episode->episode_number }}</span>
        </nav>

        <!-- Episode Masthead Header -->
        <header class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <span class="px-3 py-1 rounded-full bg-[#0f2230] text-[#7fe3df] font-mono text-xs font-bold tracking-wider border border-[#1fb8b8]/40 shadow-[0_0_10px_rgba(31,184,184,0.2)]">
                    EPISODE #{{ $episode->episode_number }}
                </span>
                <span class="text-xs text-[#9a93a3] font-mono">
                    {{ $episode->published_at ? $episode->published_at->format('F d, Y') : 'Published' }} &bull; {{ $episode->formatted_duration ?? '58:00' }}
                </span>
            </div>

            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-bold text-[#fdf8f6] leading-[1.12] mb-6">
                {{ $episode->title }}
            </h1>

            <div class="h-0.5 w-16 mb-6 rounded-full bg-gradient-to-r from-[#1fb8b8] to-[#ef6b9c]"></div>

            <p class="font-serif italic text-lg sm:text-xl text-[#f6edf0]/85 leading-relaxed max-w-3xl mb-8">
                {{ $episode->short_description }}
            </p>

            <!-- Guest & Host Credits Card -->
            <div class="card-editorial p-6 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 border border-[rgba(253,248,246,0.12)]">
                <div class="flex items-center gap-4">
                    @if($episode->guest)
                    <div class="w-14 h-14 rounded-full overflow-hidden bg-[#0f2230] border-2 border-[#1fb8b8]/60 shadow-[0_0_12px_rgba(31,184,184,0.25)] shrink-0">
                        <img src="{{ $episode->guest->photo_url }}" alt="{{ $episode->guest->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-[#7fe3df] font-mono">FEATURED GUEST</div>
                        <p class="text-base font-bold text-[#fdf8f6]">{{ $episode->guest->name }}</p>
                        <p class="text-xs text-[#9a93a3]">{{ $episode->guest->designation }}</p>
                    </div>
                    @endif
                </div>

                <!-- Primary Play Button Trigger -->
                <button type="button" class="btn-grad play-track-btn w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-full font-bold text-xs uppercase tracking-wider text-white cursor-pointer"
                    data-title="{{ $episode->title }}"
                    data-guest="{{ $episode->guest->name ?? 'Guest' }}"
                    data-duration="{{ $episode->formatted_duration ?? '58:00' }}"
                    data-cover="{{ $episode->artwork_url }}"
                    data-audio="{{ $episode->audio_url }}">
                    <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <span>Listen to Dialogue</span>
                </button>
            </div>
        </header>

        <!-- Video Embed or Artwork Banner -->
        @if($episode->youtube_id)
        <section class="mb-14">
            <div class="aspect-video w-full rounded-2xl overflow-hidden shadow-2xl border border-[rgba(253,248,246,0.12)] bg-[#070d17]">
                <iframe 
                    class="w-full h-full"
                    src="https://www.youtube-nocookie.com/embed/{{ $episode->youtube_id }}?rel=0" 
                    title="{{ $episode->title }}" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            <div class="flex items-center justify-between text-xs text-[#9a93a3] mt-3 px-1 font-mono">
                <span>YouTube High-Definition Video &bull; Permanent Archive</span>
                <a href="{{ $episode->youtube_url }}" target="_blank" rel="noopener" class="text-[#7fe3df] hover:text-[#ffb3d1] font-semibold">Watch on YouTube &rarr;</a>
            </div>
        </section>
        @elseif($episode->artwork_url)
        <section class="mb-14">
            <div class="aspect-[16/9] max-h-[460px] w-full rounded-2xl overflow-hidden shadow-2xl border border-[rgba(253,248,246,0.12)] bg-[#070d17] relative">
                <img src="{{ $episode->artwork_url }}" alt="{{ $episode->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a1620] via-transparent to-transparent opacity-60"></div>
            </div>
        </section>
        @endif

        <!-- Narrative Show Notes -->
        <section class="mb-12 sm:mb-14 card-editorial p-4 sm:p-6 lg:p-8 rounded-2xl">
            <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#fdf8f6] border-b border-[rgba(253,248,246,0.1)] pb-3 mb-6">
                Show Notes &amp; Conversation Overview
            </h2>
            <div class="text-sm sm:text-base text-[#f6edf0]/80 leading-relaxed space-y-4 font-normal">
                {!! $episode->full_show_notes !!}
            </div>
        </section>

        <!-- Key Quotations & Insights -->
        @if(!empty($episode->key_quotations))
        <section class="mb-12 sm:mb-14">
            <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#fdf8f6] border-b border-[rgba(253,248,246,0.1)] pb-3 mb-6">
                Key Quotations
            </h2>
            <div class="space-y-4 sm:space-y-6">
                @php
                    $quotes = is_array($episode->key_quotations) ? $episode->key_quotations : json_decode($episode->key_quotations, true);
                @endphp
                @foreach($quotes as $item)
                <blockquote class="card-editorial p-4 sm:p-6 rounded-xl border-l-4 border-l-[#1fb8b8]">
                    <p class="font-serif italic text-base sm:text-lg text-[#fdf8f6] mb-3 leading-relaxed">
                        "{{ $item['quote'] ?? '' }}"
                    </p>
                    <cite class="not-italic text-xs font-bold uppercase tracking-wider text-[#7fe3df] block font-mono">
                        &mdash; {{ $item['speaker'] ?? ($episode->guest->name ?? 'Featured Voice') }}
                    </cite>
                </blockquote>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Searchable, Crawlable Structured Transcript -->
        <section id="transcript" class="mb-12 sm:mb-16">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-[rgba(253,248,246,0.1)] pb-3 mb-6">
                <div>
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#fdf8f6]">Crawlable Knowledge Transcript</h2>
                    <p class="text-xs text-[#9a93a3] mt-0.5">Indexed for semantic search, citation reference, and accessibility.</p>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Canonical dialogue link copied to clipboard!');" class="self-start sm:self-auto text-xs font-semibold text-[#fdf8f6] hover:text-[#7fe3df] transition-colors border border-[rgba(253,248,246,0.12)] px-3.5 py-2 rounded-lg bg-[#0f2230] cursor-pointer">
                    Copy Share Link
                </button>
            </div>

            <div class="card-editorial p-4 sm:p-6 lg:p-8 rounded-2xl">
                <div class="space-y-6 text-sm text-[#f6edf0]/80 leading-relaxed font-normal">
                    @if($episode->transcript)
                        @foreach(explode("\n\n", trim($episode->transcript)) as $turn)
                            @if(trim($turn))
                            <div class="p-3.5 rounded-lg hover:bg-[#0f2230] transition-colors border border-transparent hover:border-[rgba(253,248,246,0.1)]">
                                <p class="leading-relaxed">
                                    {{ $turn }}
                                </p>
                            </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-[#9a93a3] italic">Complete verbatim transcript is being indexed by our editorial team.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Relevant Links & Literature -->
        @if(!empty($episode->relevant_links))
        <section class="mb-14 p-6 rounded-2xl card-editorial">
            <h2 class="font-serif text-xl font-bold text-[#fdf8f6] mb-3">Relevant Links &amp; Referenced Resources</h2>
            <ul class="space-y-2.5 text-xs text-[#f6edf0]/80">
                @php
                    $links = is_array($episode->relevant_links) ? $episode->relevant_links : json_decode($episode->relevant_links, true);
                @endphp
                @foreach($links as $link)
                <li class="flex items-center gap-2">
                    <span class="text-[#7fe3df]">&rarr;</span>
                    <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener" class="underline hover:text-[#7fe3df] font-medium">
                        {{ $link['label'] ?? ($link['url'] ?? '') }}
                    </a>
                </li>
                @endforeach
            </ul>
        </section>
        @endif

        <!-- Guest Profile Capsule -->
        @if($episode->guest)
        <section class="card-editorial p-8 rounded-2xl mb-16 border border-[rgba(253,248,246,0.12)]">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="w-20 h-20 rounded-2xl overflow-hidden bg-[#0f2230] border-2 border-[#1fb8b8]/60 shadow-[0_0_15px_rgba(31,184,184,0.25)] shrink-0">
                    <img src="{{ $episode->guest->photo_url }}" alt="{{ $episode->guest->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#7fe3df] font-mono">ABOUT THE GUEST</span>
                    <h2 class="font-serif text-xl font-bold text-[#fdf8f6] mt-0.5">{{ $episode->guest->name }}</h2>
                    <p class="text-xs text-[#9a93a3] mb-3">{{ $episode->guest->designation }} &bull; {{ $episode->guest->affiliation }}</p>
                    <p class="text-xs text-[#f6edf0]/80 leading-relaxed mb-4">
                        {{ $episode->guest->bio }}
                    </p>
                    <a href="{{ route('guests.show', $episode->guest->slug) }}" class="text-xs font-bold uppercase tracking-wider text-[#7fe3df] hover:text-[#ffb3d1] inline-flex items-center gap-1 font-mono">
                        <span>View Guest Profile &amp; Other Episodes</span> &rarr;
                    </a>
                </div>
            </div>
        </section>
        @endif

    </div>
</article>
@endsection
