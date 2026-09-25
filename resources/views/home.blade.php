@extends('layouts.app')

@section('title', 'The Listening Commons — An Independent Dialogue Initiative')
@section('meta_description', 'The Listening Commons is an unhurried sanctuary for deep inquiry into mental peace, human dignity, restorative justice, ethical technology, and lived experience.')

@section('content')
<!-- BEGIN: HeroSection (Matching exact theme & aurora pattern from D:\website) -->
<header class="hero relative pt-12 sm:pt-16 pb-8 border-b border-[rgba(253,248,246,0.1)] overflow-hidden" data-purpose="editorial-hero">
    <!-- Local Aurora Fluid Gradient Pattern -->
    <div class="aurora" aria-hidden="true">
        <span class="a1"></span>
        <span class="a2"></span>
        <span class="a3"></span>
        <span class="a4"></span>
    </div>
    <div class="noise-overlay" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <!-- Exact Eyebrow Kicker from Reference -->
        <p class="hero-kicker mb-6 sm:mb-8">
            AN INDEPENDENT DIALOGUE INITIATIVE &bull; DR. ANINDA SIDHANA &bull; SCOTT DOUGLAS JACOBSEN
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            <!-- Left Column: Title, Subtitle, CTA Actions and Executive Metric Chips (7 cols) -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <h1 class="hero-name font-serif text-4xl sm:text-6xl lg:text-[4.2rem] leading-[1.08] text-[#fdf8f6] font-normal tracking-tight mb-4">
                        Where conversations become<br class="hidden sm:inline">
                        <span class="em italic font-normal">common ground.</span>
                    </h1>
                    <!-- Signature Aurora Accent Bar -->
                    <div class="hero-rule mb-6 sm:mb-8" style="width: 80px; height: 3px; background: linear-gradient(90deg, #7fe3df, #ffb3d1); border-radius: 999px;"></div>
                    
                    <p class="hero-desc text-base sm:text-xl text-[#f6edf0]/80 font-light leading-relaxed max-w-2xl mb-8">
                        <strong class="font-medium text-[#fdf8f6] block mb-2 text-lg sm:text-2xl not-italic font-serif">Turning lived experience into sovereign understanding.</strong>
                        An unhurried sanctuary for deep inquiry into the questions that define our collective life: mental peace, human dignity, restorative justice, ethical technology, and the enduring power of listening.
                    </p>
                </div>

                <!-- CTA Actions (100% Matched Button Aesthetics) -->
                <div class="hero-actions flex flex-wrap gap-3.5 sm:gap-4 mb-8 items-center">
                    <a href="{{ route('episodes.index') }}" class="btn-grad">
                        Explore Conversations &rarr;
                    </a>
                    <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="btn-glass" style="border-color: rgba(31,184,184,0.4); color: var(--teal-lt);">
                        Dr. Aninda Sidhana &rarr;
                    </a>
                </div>

                <!-- Editorial Topic Index Badges -->
                <div class="pt-6 border-t border-[rgba(253,248,246,0.1)]">
                    <span class="text-[11px] font-sans uppercase tracking-[0.2em] text-[#9a93a3] block mb-3 font-medium">Curated Fields of Inquiry</span>
                    <div class="flex flex-wrap gap-2">
                        <a class="px-3.5 py-1.5 text-xs font-sans text-[#fdf8f6] bg-[#0f2230] hover:bg-[#1fb8b8] hover:text-[#0a1620] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-all duration-150 rounded-full font-medium" href="{{ route('themes.show', 'mental-health') }}">Mental Health</a>
                        <a class="px-3.5 py-1.5 text-xs font-sans text-[#fdf8f6] bg-[#0f2230] hover:bg-[#1fb8b8] hover:text-[#0a1620] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-all duration-150 rounded-full font-medium" href="{{ route('themes.show', 'human-dignity') }}">Human Dignity</a>
                        <a class="px-3.5 py-1.5 text-xs font-sans text-[#fdf8f6] bg-[#0f2230] hover:bg-[#1fb8b8] hover:text-[#0a1620] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-all duration-150 rounded-full font-medium" href="{{ route('themes.show', 'peace-reconciliation') }}">Peace &amp; Reconciliation</a>
                        <a class="px-3.5 py-1.5 text-xs font-sans text-[#fdf8f6] bg-[#0f2230] hover:bg-[#1fb8b8] hover:text-[#0a1620] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-all duration-150 rounded-full font-medium" href="{{ route('themes.show', 'gender-belonging') }}">Gender &amp; Belonging</a>
                        <a class="px-3.5 py-1.5 text-xs font-sans text-[#fdf8f6] bg-[#0f2230] hover:bg-[#1fb8b8] hover:text-[#0a1620] border border-[rgba(253,248,246,0.12)] hover:border-[#1fb8b8] transition-all duration-150 rounded-full font-medium" href="{{ route('themes.show', 'ai-humanity') }}">AI &amp; Humanity</a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Featured Dialogue Archival Card (5 cols) -->
            @if($featuredEpisode)
            <div class="lg:col-span-5 bg-[#0f2230]/80 border border-[rgba(253,248,246,0.12)] backdrop-blur-xl shadow-2xl p-5 sm:p-7 relative rounded-2xl glow-aurora" data-purpose="featured-conversation-card" id="featured-dialogue">
                <!-- Top card badge -->
                <div class="flex items-center justify-between pb-4 border-b border-[rgba(253,248,246,0.1)]">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-[#1fb8b8] shadow-[0_0_8px_#1fb8b8]"></span>
                        <span class="text-[10px] tracking-[0.2em] font-semibold text-[#7fe3df] uppercase font-mono">Featured Episode</span>
                    </div>
                    <span class="text-[11px] font-serif italic text-[#9a93a3]">Recorded {{ $featuredEpisode->published_at ? $featuredEpisode->published_at->format('M d, Y') : 'Sep 15, 2026' }}</span>
                </div>

                <!-- Acoustic Frequency & Inquiry Excerpt (Imageless Audio Console) -->
                <div class="mt-5 p-5 sm:p-6 bg-gradient-to-br from-[#070d17] via-[#0a1620] to-[#0f2230] border border-[rgba(253,248,246,0.1)] rounded-2xl relative overflow-hidden group">
                    <!-- Subtle ambient glow background -->
                    <div class="absolute -top-12 -right-12 w-40 h-40 bg-[#1fb8b8]/15 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#ef6b9c]/15 rounded-full blur-2xl pointer-events-none"></div>

                    <!-- Episode Number & Duration Badges -->
                    <div class="flex items-center justify-between gap-3 mb-4 relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0a1620]/90 border border-[#1fb8b8]/40 text-[#7fe3df] font-mono text-[11px] tracking-widest uppercase font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#1fb8b8] animate-pulse"></span>
                            Episode #{{ sprintf('%02d', $featuredEpisode->episode_number ?? 1) }}
                        </div>
                        <span class="font-mono text-xs text-[#9a93a3] px-2.5 py-1 rounded-md bg-[#0a1620]/80 border border-[rgba(253,248,246,0.1)]">
                            {{ $featuredEpisode->formatted_duration ?? '57:00' }}
                        </span>
                    </div>

                    <!-- Interactive Waveform Amplitude Spectrum -->
                    <div class="py-2 flex items-end justify-between gap-1 sm:gap-1.5 h-14 sm:h-16 border-b border-[rgba(253,248,246,0.08)] mb-4 relative z-10" aria-label="Audio Waveform Display">
                        @foreach([25, 45, 35, 75, 60, 90, 40, 70, 85, 55, 35, 65, 80, 48, 95, 100, 75, 58, 85, 42, 65, 78, 50, 72, 88, 62, 38, 55, 78, 58, 40, 30] as $barHeight)
                        <span class="waveform-bar flex-1 bg-gradient-to-t from-[#1fb8b8]/40 to-[#7fe3df]/80 hover:from-[#ef6b9c] hover:to-[#ffb3d1] rounded-full transition-all duration-300" style="height: {{ $barHeight }}%;"></span>
                        @endforeach
                    </div>

                    <!-- Narrative Inquiry Excerpt -->
                    <blockquote class="relative z-10 font-serif italic text-xs sm:text-sm text-[#fdf8f6]/85 leading-relaxed line-clamp-3">
                        &ldquo;{{ Str::limit($featuredEpisode->short_description ?? 'An unhurried sanctuary for deep inquiry into mental health, human dignity, and lived experience.', 170) }}&rdquo;
                    </blockquote>
                </div>

                <!-- Episode Narrative & Meta -->
                <div class="mt-5 sm:mt-6">
                    <h2 class="font-serif text-xl sm:text-2xl leading-snug font-medium text-[#fdf8f6] hover:text-[#7fe3df] transition-colors">
                        <a href="{{ route('episodes.show', $featuredEpisode->slug) }}">
                            {{ $featuredEpisode->title }}
                        </a>
                    </h2>

                    <!-- Guest details -->
                    @if($featuredEpisode->guest)
                    <div class="mt-4 flex items-center space-x-3.5 pb-4 border-b border-[rgba(253,248,246,0.1)]">
                        <div class="w-10 h-10 rounded-full border border-[#1fb8b8]/40 overflow-hidden bg-[#0f2230] shrink-0">
                            <img alt="{{ $featuredEpisode->guest->name }}" class="w-full h-full object-cover" src="{{ $featuredEpisode->guest->photo_url }}" />
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-semibold uppercase tracking-wider text-[#fdf8f6] truncate">{{ $featuredEpisode->guest->name }}</p>
                            <p class="text-[11px] text-[#9a93a3] truncate">{{ $featuredEpisode->guest->designation }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Action Triggers -->
                    <div class="mt-6 flex flex-col sm:flex-row items-center gap-3">
                        <button type="button" class="btn-grad play-track-btn w-full sm:w-auto flex-1 py-3 px-5 text-xs font-semibold uppercase tracking-widest flex items-center justify-center space-x-2 rounded-full cursor-pointer"
                            data-title="{{ $featuredEpisode->title }}"
                            data-guest="{{ $featuredEpisode->guest->name ?? 'Guest' }}"
                            data-duration="{{ $featuredEpisode->formatted_duration ?? '57:00' }}"
                            data-cover="{{ $featuredEpisode->artwork_url }}"
                            data-audio="{{ $featuredEpisode->audio_url }}">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                            </svg>
                            <span>Click to Listen</span>
                        </button>
                        <a class="btn-glass w-full sm:w-auto text-center py-3 px-5 text-xs uppercase tracking-widest font-semibold rounded-full" href="{{ route('episodes.show', $featuredEpisode->slug) }}">
                            Notes &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</header>
<!-- END: HeroSection -->

<!-- BEGIN: CreatorsSection (Scott Douglas Jacobsen & Dr. Aninda Sidhana) -->
<section class="py-16 sm:py-24 border-b border-[rgba(253,248,246,0.1)] relative z-10" data-purpose="creators-section" id="creators">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-8 border-b border-[rgba(253,248,246,0.1)] gap-4 mb-10 sm:mb-14">
            <div>
                <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#7fe3df] block mb-1 font-semibold">Leadership &amp; Curatorial Direction</span>
                <h2 class="font-serif text-2xl sm:text-4xl text-[#fdf8f6] font-normal">From the Creators</h2>
            </div>
            <div>
                <span class="text-xs uppercase tracking-widest font-mono text-[#9a93a3]">
                    Intellectual Rigour &bull; Clinical Depth
                </span>
            </div>
        </div>

        <!-- Dual Creator Profile Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
            <!-- Scott Douglas Jacobsen -->
            <article class="card-editorial p-6 sm:p-8 flex flex-col justify-between relative group rounded-2xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-gradient-to-r group-hover:from-[#1fb8b8] group-hover:to-[#ef6b9c] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center gap-4 pb-6 border-b border-[rgba(253,248,246,0.1)]">
                        <div class="w-16 h-16 rounded-full border border-[#1fb8b8]/40 bg-[#0f2230] text-[#7fe3df] flex items-center justify-center font-display text-lg font-bold shrink-0 shadow-inner">
                            SJ
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#7fe3df] block font-semibold">Founder &amp; Creator</span>
                            <h3 class="font-serif text-xl sm:text-2xl font-medium text-[#fdf8f6] mt-0.5">Scott Douglas Jacobsen</h3>
                            <span class="text-xs text-[#9a93a3] font-sans">Independent Canadian Journalist &bull; Publisher, In-Sight Publishing</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3.5 font-serif text-xs sm:text-sm text-[#9a93a3] leading-relaxed font-light">
                        <p>
                            Scott Douglas Jacobsen is an independent Canadian journalist, interviewer, editor, and publisher. He is the Founder and Publisher of In-Sight Publishing and Editor-in-Chief of In-Sight: Interviews. His extensive body of work engages with human rights, science, culture, public policy, and the ideas shaping contemporary society.
                        </p>
                        <p>
                            Through The Listening Commons, he creates space for intellectually rigorous, independent, and deeply humane conversations across disciplines, cultures, and worldviews.
                        </p>
                    </div>

                    <blockquote class="mt-6 pt-4 border-t border-[rgba(253,248,246,0.1)] font-serif italic text-xs text-[#7fe3df]">
                        &ldquo;Curiosity before certainty.&rdquo;
                    </blockquote>
                </div>

                <div class="mt-8 pt-4 border-t border-[rgba(253,248,246,0.1)] flex items-center justify-between text-xs font-mono">
                    <span class="text-[11px] text-[#9a93a3]">Editorial &amp; Syndication</span>
                    <a href="https://in-sightpublishing.com/" target="_blank" rel="noopener" class="text-[#7fe3df] hover:text-[#ffb3d1] uppercase tracking-wider font-semibold inline-flex items-center gap-1.5 transition-colors">
                        <span>Explore In-Sight Publishing</span> &rarr;
                    </a>
                </div>
            </article>

            <!-- Dr. Aninda Sidhana -->
            <article class="card-editorial p-6 sm:p-8 flex flex-col justify-between relative group rounded-2xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-gradient-to-r group-hover:from-[#1fb8b8] group-hover:to-[#ef6b9c] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center gap-4 pb-6 border-b border-[rgba(253,248,246,0.1)]">
                        <div class="w-16 h-16 rounded-full border border-[#1fb8b8]/40 bg-[#0f2230] text-[#7fe3df] flex items-center justify-center font-display text-lg font-bold shrink-0 shadow-inner">
                            AS
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#7fe3df] block font-semibold">Co-Creator &amp; Clinical–Editorial Lead</span>
                            <h3 class="font-serif text-xl sm:text-2xl font-medium text-[#fdf8f6] mt-0.5">Dr. Aninda Sidhana</h3>
                            <span class="text-xs text-[#9a93a3] font-sans">Psychiatrist &bull; Psychosexual Medicine &bull; WICCI Council President</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3.5 font-serif text-xs sm:text-sm text-[#9a93a3] leading-relaxed font-light">
                        <p>
                            Dr. Aninda Sidhana is a psychiatrist and psychosexual-medicine specialist whose work bridges mental health, trauma-informed care, women’s wellbeing, culture, storytelling, and human dignity.
                        </p>
                        <p>
                            As National President of the WICCI National Psychosocial &amp; Mental Wellness Council and Founder of The Dignity Dialogues™, she works to move mental health beyond clinical walls and into culture, media, and public conversation. Through The Listening Commons, she brings psychiatric insight, lived humanity, and dignity-centred inquiry into dialogue with art, consciousness, and the human condition.
                        </p>
                    </div>

                    <blockquote class="mt-6 pt-4 border-t border-[rgba(253,248,246,0.1)] font-serif italic text-xs text-[#7fe3df]">
                        &ldquo;Listening is not the pause before speaking. It is a form of knowledge, dignity and relationship.&rdquo;
                    </blockquote>
                </div>

                <div class="mt-8 pt-4 border-t border-[rgba(253,248,246,0.1)] flex flex-wrap items-center justify-between gap-3 text-xs font-mono">
                    <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="text-[#7fe3df] hover:text-[#ffb3d1] uppercase tracking-wider font-semibold inline-flex items-center gap-1 transition-colors">
                        <span>Dr. Sidhana's Work</span> &rarr;
                    </a>
                    <a href="https://dranindasidhana.substack.com/" target="_blank" rel="noopener" class="text-[#9a93a3] hover:text-[#7fe3df] text-[11px] inline-flex items-center gap-1 transition-colors">
                        <span>The Dignity Dialogues</span> &rarr;
                    </a>
                </div>
            </article>
        </div>

        <!-- Institutional Collaboration Block (WICCI) -->
        <div class="mt-10 sm:mt-12 card-editorial p-6 sm:p-8 relative overflow-hidden rounded-2xl" data-purpose="wicci-collaboration">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-6 border-b border-[rgba(253,248,246,0.1)]">
                <div>
                    <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-[#7fe3df] font-semibold block mb-1">
                        Institutional Collaboration
                    </span>
                    <h3 class="font-serif text-lg sm:text-xl font-medium text-[#fdf8f6]">
                        WICCI National Psychosocial &amp; Mental Wellness Council
                    </h3>
                    <p class="text-xs text-[#9a93a3] font-sans mt-0.5">
                        Led by Dr. Aninda Sidhana, National President
                    </p>
                </div>
                <div class="px-3.5 py-1.5 rounded-full bg-[#0a1620] border border-[rgba(253,248,246,0.15)] text-[#7fe3df] font-mono text-[11px] shrink-0 font-semibold">
                    Public Interest Partnership
                </div>
            </div>

            <p class="mt-5 font-serif text-xs sm:text-sm text-[#9a93a3] leading-relaxed max-w-4xl font-light">
                This collaboration advances responsible public conversations around mental health, psychosocial wellbeing, storytelling, inclusion, dignity, and media ethics. It brings together clinical knowledge, cultural dialogue, and public leadership to encourage narratives that deepen understanding rather than stigma.
            </p>
        </div>
    </div>
</section>
<!-- END: CreatorsSection -->

<!-- BEGIN: ChronologicalArchiveSection -->
<section class="py-16 sm:py-20 border-b border-[rgba(253,248,246,0.1)] relative z-10" data-purpose="chronological-archive" id="dialogues">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-8 border-b border-[rgba(253,248,246,0.1)] gap-4">
            <div>
                <span class="text-[11px] font-mono tracking-[0.2em] uppercase text-[#7fe3df] block mb-1 font-semibold">Chronological Archive</span>
                <h2 class="font-serif text-2xl sm:text-3xl text-[#fdf8f6] font-normal">Recent Conversations</h2>
            </div>
            <div>
                <a class="text-xs uppercase tracking-widest font-semibold text-[#7fe3df] hover:text-[#ffb3d1] inline-flex items-center space-x-2 border-b border-[#1fb8b8]/60 pb-1 hover:border-[#ffb3d1] transition-all font-mono" href="{{ route('episodes.index') }}">
                    <span>View Full Episode Archive</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Dialogue Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mt-10 sm:mt-12">
            @foreach($latestEpisodes->take(3) as $ep)
            <!-- Conversation Card (Styled like Proto-Card in D:\website) -->
            <article class="card-editorial p-6 flex flex-col justify-between relative group rounded-2xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-gradient-to-r group-hover:from-[#1fb8b8] group-hover:to-[#ef6b9c] transition-colors rounded-t-2xl"></div>
                <div>
                    <!-- Header Meta -->
                    <div class="flex items-center justify-between text-[11px] font-mono text-[#9a93a3] pb-4 border-b border-[rgba(253,248,246,0.1)]">
                        <span class="font-bold text-[#7fe3df] uppercase">Episode #{{ sprintf('%02d', $ep->episode_number) }}</span>
                        <span>{{ $ep->formatted_duration ?? '57:00' }}</span>
                    </div>

                    <h3 class="font-serif text-xl font-medium mt-4 text-[#fdf8f6] group-hover:text-[#7fe3df] transition-colors leading-snug">
                        <a href="{{ route('episodes.show', $ep->slug) }}">{{ $ep->title }}</a>
                    </h3>

                    <p class="mt-3 text-xs font-serif text-[#9a93a3] leading-relaxed italic line-clamp-3">
                        {{ $ep->short_description }}
                    </p>
                </div>

                <div class="mt-8 pt-4 border-t border-[rgba(253,248,246,0.1)] flex items-center justify-between">
                    <div class="truncate pr-3">
                        <p class="text-[11px] font-sans font-semibold text-[#fdf8f6] uppercase tracking-wider truncate">{{ $ep->guest->name ?? 'Featured Guest' }}</p>
                        <p class="text-[10px] text-[#9a93a3] truncate">{{ $ep->guest->designation ?? 'Guest' }}</p>
                    </div>
                    <button type="button" aria-label="Play Episode {{ $ep->episode_number }}" class="play-track-btn w-9 h-9 rounded-full border border-[rgba(253,248,246,0.15)] bg-[#0f2230] flex items-center justify-center text-[#fdf8f6] group-hover:bg-gradient-to-r group-hover:from-[#1fb8b8] group-hover:to-[#ef6b9c] group-hover:border-transparent group-hover:text-white group-hover:shadow-[0_0_15px_rgba(239,107,156,0.4)] transition-all shrink-0 cursor-pointer"
                        data-title="{{ $ep->title }}"
                        data-guest="{{ $ep->guest->name ?? 'Guest' }}"
                        data-duration="{{ $ep->formatted_duration ?? '55:00' }}"
                        data-cover="{{ $ep->artwork_url }}"
                        data-audio="{{ $ep->audio_url }}">
                        <svg class="w-3.5 h-3.5 fill-current ml-0.5" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                        </svg>
                    </button>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
<!-- END: ChronologicalArchiveSection -->



<!-- BEGIN: ManifestoPullQuote -->
<section class="py-20 sm:py-28 bg-[#070d17]/80 border-b border-[rgba(253,248,246,0.1)] relative overflow-hidden z-10" data-purpose="manifesto-callout" id="manifesto">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <!-- Ornamental Seal with Aurora Rim -->
        <div class="w-12 h-12 mx-auto rounded-full border border-[#1fb8b8]/50 bg-[#0f2230] flex items-center justify-center mb-8 text-[#7fe3df] shadow-[0_0_20px_rgba(31,184,184,0.3)]">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14h2v2h-2v-2zm0-10h2v8h-2V6z"></path>
            </svg>
        </div>

        <blockquote class="font-serif text-2xl sm:text-4xl md:text-[2.6rem] text-[#fdf8f6] leading-relaxed font-normal tracking-tight">
            &ldquo;We listen not to defeat an opponent, but to uncover the sacred ground between us.&rdquo;
        </blockquote>

        <p class="mt-8 text-sm sm:text-base font-serif text-[#9a93a3] max-w-2xl mx-auto leading-relaxed font-light">
            In an era driven by algorithmic division and weaponized outrage, The Listening Commons creates a digital sanctuary where disagreement does not preclude human dignity, and where curiosity outlives certainty.
        </p>

        <div class="mt-10">
            <a class="btn-grad inline-flex items-center space-x-3 px-8 py-3.5 text-xs uppercase tracking-widest font-semibold rounded-full shadow-lg" href="{{ route('about') }}">
                <span>Read Our Charter &amp; Philosophy</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>
</section>
<!-- END: ManifestoPullQuote -->
@endsection
