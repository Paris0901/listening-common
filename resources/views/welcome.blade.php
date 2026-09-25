@extends('layouts.app')

@section('title', 'Listening Common — Sound, Stories & Audio Production Portfolio')

@section('content')
<!-- Hero Section -->
<section id="latest" class="relative pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Hero Text -->
            <div class="lg:col-span-7 flex flex-col items-start">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 mb-6">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>NEW EPISODE 42 DROPPED</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                    Where Sound Design Meets <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-200 to-orange-400">Creative Tech</span>
                </h1>

                <p class="text-base sm:text-lg text-zinc-300 leading-relaxed mb-8 max-w-2xl">
                    Welcome to <strong class="text-white font-semibold">Listening Common</strong> — a weekly podcast and audio engineering portfolio dissecting spatial acoustics, sonic branding, generative synthesis, and longform conversations with leading sonic innovators.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 w-full sm:w-auto">
                    <button type="button" class="hero-play-btn inline-flex items-center justify-center gap-3 px-6 py-3.5 rounded-xl font-bold text-sm bg-amber-500 hover:bg-amber-400 text-zinc-950 shadow-xl shadow-amber-500/20 transition-all hover:scale-[1.02] active:scale-95 cursor-pointer"
                        data-episode-id="42"
                        data-title="Ep. 42: The Architecture of Spatial Audio"
                        data-guest="Dr. Elena Vance (Dolby Labs)"
                        data-duration="48:12"
                        data-cover="#42">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Play Featured Episode
                    </button>

                    <a href="#portfolio" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-sm bg-zinc-900/80 hover:bg-zinc-800 text-zinc-200 border border-zinc-700/70 hover:border-zinc-500 transition-all">
                        <span>Explore Portfolio</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>

                <!-- Metrics Strip -->
                <div class="grid grid-cols-3 gap-6 pt-10 mt-10 border-t border-zinc-800/80 w-full max-w-xl text-left">
                    <div>
                        <div class="text-2xl font-bold text-white tracking-tight">42+</div>
                        <div class="text-xs text-zinc-400 mt-0.5">Deep Dive Episodes</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white tracking-tight">2.4M</div>
                        <div class="text-xs text-zinc-400 mt-0.5">Global Streams</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white tracking-tight">15+ yrs</div>
                        <div class="text-xs text-zinc-400 mt-0.5">Studio Production</div>
                    </div>
                </div>
            </div>

            <!-- Featured Episode Spotlight Card -->
            <div class="lg:col-span-5">
                <div class="relative rounded-3xl p-6 sm:p-8 bg-gradient-to-b from-zinc-900/90 to-zinc-950/90 border border-zinc-800 shadow-2xl backdrop-blur-md group hover:border-amber-500/40 transition-colors">
                    <!-- Top Ribbon -->
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <span class="px-3 py-1 rounded-md text-[11px] font-bold tracking-wider uppercase bg-amber-500/20 text-amber-300 border border-amber-500/30">
                            LATEST EPISODE
                        </span>
                        <span class="text-xs font-mono text-zinc-400">Recorded in Dolby Atmos</span>
                    </div>

                    <!-- Artwork and Guest Preview -->
                    <div class="flex items-center gap-5 mb-6">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-amber-500 via-orange-600 to-violet-700 p-0.5 shadow-xl shrink-0">
                            <div class="w-full h-full rounded-2xl bg-zinc-900/80 flex items-center justify-center text-white font-extrabold text-xl">
                                #42
                            </div>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-amber-400 uppercase tracking-wider">Spatial Audio &bull; Acoustics</span>
                            <h3 class="text-lg font-bold text-white leading-snug">The Architecture of Spatial Audio</h3>
                            <p class="text-xs text-zinc-400 mt-1">Guest: Dr. Elena Vance (Spatial Audio Lead, Dolby)</p>
                        </div>
                    </div>

                    <!-- Simulated Sound Waveform -->
                    <div class="bg-zinc-950/70 border border-zinc-800/80 rounded-xl p-4 mb-6">
                        <div class="flex items-end justify-between gap-1 h-12 py-1 px-1">
                            <div class="w-1.5 bg-amber-400 rounded-full h-[40%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[75%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[60%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[95%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[30%]"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[85%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[50%]"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[100%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[65%]"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[45%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[90%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[70%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[40%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[80%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[55%]"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[35%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[85%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[60%]"></div>
                            <div class="w-1.5 bg-amber-500 rounded-full h-[90%] animate-pulse"></div>
                            <div class="w-1.5 bg-amber-400 rounded-full h-[45%]"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-zinc-400 font-mono mt-2">
                            <span>04:18</span>
                            <span>Full Episode (48:12)</span>
                        </div>
                    </div>

                    <!-- Topic Highlights -->
                    <div class="space-y-2 text-xs text-zinc-300 mb-6">
                        <div class="flex items-center gap-2">
                            <span class="text-amber-400">&bull;</span>
                            <span>Binaural rendering vs object-based audio systems</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-amber-400">&bull;</span>
                            <span>Acoustic room impulse responses in modern gaming</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-amber-400">&bull;</span>
                            <span>The future of soundscapes for AR and VR hardware</span>
                        </div>
                    </div>

                    <!-- Card Listen Trigger -->
                    <button type="button" class="hero-play-btn w-full py-3 px-4 rounded-xl font-bold text-xs bg-zinc-800 hover:bg-amber-500 hover:text-zinc-950 text-white transition-all flex items-center justify-center gap-2 border border-zinc-700/60 cursor-pointer"
                        data-episode-id="42"
                        data-title="Ep. 42: The Architecture of Spatial Audio"
                        data-guest="Dr. Elena Vance (Dolby Labs)"
                        data-duration="48:12"
                        data-cover="#42">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Listen to This Episode Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Podcast Episodes Section -->
<section id="episodes" class="py-20 border-t border-zinc-800/80 bg-zinc-900/30 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">ARCHIVE &amp; BROADCASTS</div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Recent Podcast Episodes</h2>
                <p class="text-sm text-zinc-400 mt-2 max-w-xl">Curated conversations covering the art, engineering, and storytelling powering today's audio medium.</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                <button type="button" class="filter-btn active px-3.5 py-1.5 rounded-lg bg-amber-500 text-zinc-950 transition-colors" data-filter="all">All</button>
                <button type="button" class="filter-btn px-3.5 py-1.5 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-800 transition-colors" data-filter="tech">Creative Tech</button>
                <button type="button" class="filter-btn px-3.5 py-1.5 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-800 transition-colors" data-filter="story">Storytelling</button>
                <button type="button" class="filter-btn px-3.5 py-1.5 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-800 transition-colors" data-filter="sound">Sound Design</button>
            </div>
        </div>

        <!-- Episodes Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Episode 42 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="tech">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 42</span>
                    <span class="text-xs text-zinc-500">Oct 12, 2026 &bull; 48 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    The Architecture of Spatial Audio &amp; Binaural Fields
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    How head-related transfer functions (HRTF) and 3D audio engines are redefining presence in media, VR games, and next-generation headphones.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        EV
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Dr. Elena Vance</span>
                        <span class="text-zinc-500 block text-[11px] truncate">Dolby Labs Audio Research</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="42"
                        data-title="Ep. 42: The Architecture of Spatial Audio"
                        data-guest="Dr. Elena Vance (Dolby Labs)"
                        data-duration="48:12"
                        data-cover="#42">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>

            <!-- Episode 41 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="sound">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 41</span>
                    <span class="text-xs text-zinc-500">Sep 28, 2026 &bull; 54 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    Sonic Worldbuilding in Indie Cinema &amp; Games
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    Award-winning sound supervisor Julian Moore walks through field recording in volcanic tundras and modular synthesizers for sci-fi atmosphere.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        JM
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Julian Moore</span>
                        <span class="text-zinc-500 block text-[11px] truncate">Lead Sound Designer, Neon Orbit</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="41"
                        data-title="Ep. 41: Sonic Worldbuilding in Cinema"
                        data-guest="Julian Moore (Neon Orbit)"
                        data-duration="54:30"
                        data-cover="#41">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>

            <!-- Episode 40 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="story">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 40</span>
                    <span class="text-xs text-zinc-500">Sep 14, 2026 &bull; 42 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    Pacing the Invisible: The Art of Audio Documentaries
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    Investigative audio producer Sarah Kincaid explains rhythm, narrative pacing, silence, and oral history interview techniques that keep listeners gripped.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        SK
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Sarah Kincaid</span>
                        <span class="text-zinc-500 block text-[11px] truncate">Executive Producer, Radiant Radio</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="40"
                        data-title="Ep. 40: Pacing the Invisible: Audio Docs"
                        data-guest="Sarah Kincaid (Radiant Radio)"
                        data-duration="42:15"
                        data-cover="#40">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>

            <!-- Episode 39 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="tech">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 39</span>
                    <span class="text-xs text-zinc-500">Aug 30, 2026 &bull; 61 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    Neural Audio Synthesis &amp; Machine Listening
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    Exploring differentiable DSP, latent timbre morphing, and ethical frontiers of generative vocal acoustics with researchers from Stanford CCRMA.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        AR
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Prof. Aris Thorne</span>
                        <span class="text-zinc-500 block text-[11px] truncate">CCRMA Sound Research</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="39"
                        data-title="Ep. 39: Neural Audio Synthesis & DSP"
                        data-guest="Prof. Aris Thorne (CCRMA)"
                        data-duration="61:05"
                        data-cover="#39">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>

            <!-- Episode 38 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="sound">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 38</span>
                    <span class="text-xs text-zinc-500">Aug 16, 2026 &bull; 39 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    Sonic Branding: Engineering a 1.2-Second Identity
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    Behind the scenes of iconic sonic logos, UI feedback chimes, EV engine hums, and emotional acoustics for modern hardware.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        MZ
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Maya Zhang</span>
                        <span class="text-zinc-500 block text-[11px] truncate">Creative Director, Resonant Sound</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="38"
                        data-title="Ep. 38: Sonic Branding: 1.2s Identity"
                        data-guest="Maya Zhang (Resonant)"
                        data-duration="39:40"
                        data-cover="#38">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>

            <!-- Episode 37 -->
            <article class="episode-card flex flex-col rounded-2xl bg-zinc-900/80 border border-zinc-800 p-6 hover:border-zinc-700 transition-all hover:-translate-y-1 duration-300 group shadow-lg" data-category="story">
                <div class="flex items-center justify-between gap-4 mb-4">
                    <span class="text-xs font-mono font-bold text-amber-400">EPISODE 37</span>
                    <span class="text-xs text-zinc-500">Aug 02, 2026 &bull; 47 min</span>
                </div>
                <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors mb-2 leading-snug">
                    Field Recording at the Edge of Silence
                </h3>
                <p class="text-xs text-zinc-400 line-clamp-3 mb-6 leading-relaxed">
                    Recording the silence of the Olympic National Park Hoh Rain Forest and preserving fragile bio-acoustic sanctuaries before acoustic extinction.
                </p>
                <div class="flex items-center gap-3 pt-4 border-t border-zinc-800/80 mt-auto">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center font-bold text-xs text-amber-400">
                        GH
                    </div>
                    <div class="text-xs truncate flex-1">
                        <span class="font-medium text-white block truncate">Gordon Hempton</span>
                        <span class="text-zinc-500 block text-[11px] truncate">Acoustic Ecologist &amp; Author</span>
                    </div>
                    <button type="button" class="play-track-btn w-9 h-9 rounded-full bg-amber-500 hover:bg-amber-400 text-zinc-950 flex items-center justify-center shadow-md shadow-amber-500/20 active:scale-95 transition-transform cursor-pointer shrink-0"
                        data-episode-id="37"
                        data-title="Ep. 37: Field Recording at the Edge"
                        data-guest="Gordon Hempton"
                        data-duration="47:18"
                        data-cover="#37">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Audio Production Portfolio Section -->
<section id="portfolio" class="py-24 border-t border-zinc-800/80 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">PRODUCTION &amp; SOUND LAB</div>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">Selected Audio Portfolio</h2>
            <p class="text-sm sm:text-base text-zinc-400 mt-3">From award-winning narrative podcast series to interactive spatial sound installations and brand soundscapes.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Project 1 -->
            <div class="rounded-3xl bg-zinc-900/60 border border-zinc-800/90 overflow-hidden hover:border-amber-500/40 transition-all duration-300 group flex flex-col justify-between">
                <div class="p-8">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">Narrative Podcast Series</span>
                        <span class="text-xs text-zinc-500">10 Episodes &bull; 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition-colors mb-3">Echoes of Orion</h3>
                    <p class="text-xs text-zinc-300 leading-relaxed mb-6">
                        An immersive sci-fi audio drama produced in Dolby Atmos. Crafted over 800 custom sound effects, synthesized alien atmospheres, and full orchestral score integration.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-mono text-zinc-400">
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Spatial Sound</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Pro Tools HD</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Dialogue Restoration</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Ambisonics</span>
                    </div>
                </div>
                <div class="p-6 bg-zinc-950/70 border-t border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 font-medium">Over 650k listeners &bull; Apple #3 Fiction</span>
                    <a href="#contact" class="text-xs font-semibold text-amber-400 hover:text-amber-300 inline-flex items-center gap-1">
                        Case Study &rarr;
                    </a>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="rounded-3xl bg-zinc-900/60 border border-zinc-800/90 overflow-hidden hover:border-amber-500/40 transition-all duration-300 group flex flex-col justify-between">
                <div class="p-8">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">Sonic Brand Identity</span>
                        <span class="text-xs text-zinc-500">Global FinTech &bull; 2025</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition-colors mb-3">Resonance Protocol</h3>
                    <p class="text-xs text-zinc-300 leading-relaxed mb-6">
                        Developed a comprehensive sonic identity guidelines, including signature app transaction chimes, notification tones, and hardware activation audio for modern mobile point-of-sale terminals.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-mono text-zinc-400">
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Sonic Logo</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Micro-Acoustics</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Hardware Integration</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">UI Audio Engine</span>
                    </div>
                </div>
                <div class="p-6 bg-zinc-950/70 border-t border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 font-medium">Deploys to 14M+ active daily devices</span>
                    <a href="#contact" class="text-xs font-semibold text-amber-400 hover:text-amber-300 inline-flex items-center gap-1">
                        Case Study &rarr;
                    </a>
                </div>
            </div>

            <!-- Project 3 -->
            <div class="rounded-3xl bg-zinc-900/60 border border-zinc-800/90 overflow-hidden hover:border-amber-500/40 transition-all duration-300 group flex flex-col justify-between">
                <div class="p-8">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Environmental Sound</span>
                        <span class="text-xs text-zinc-500">Museum Installation &bull; 2024</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition-colors mb-3">Subterranean Echoes</h3>
                    <p class="text-xs text-zinc-300 leading-relaxed mb-6">
                        A 16-channel spatial audio installation utilizing contact microphones, geophones, and binaural recordings taken inside limestone caverns and glacial tunnels.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-mono text-zinc-400">
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">16.2 Surround</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Geophone Capture</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Max/MSP</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Acoustic Ecology</span>
                    </div>
                </div>
                <div class="p-6 bg-zinc-950/70 border-t border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 font-medium">Exhibited at Contemporary Arts Centre</span>
                    <a href="#contact" class="text-xs font-semibold text-amber-400 hover:text-amber-300 inline-flex items-center gap-1">
                        Case Study &rarr;
                    </a>
                </div>
            </div>

            <!-- Project 4 -->
            <div class="rounded-3xl bg-zinc-900/60 border border-zinc-800/90 overflow-hidden hover:border-amber-500/40 transition-all duration-300 group flex flex-col justify-between">
                <div class="p-8">
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-violet-500/10 text-violet-400 border border-violet-500/20">Mastering &amp; Post</span>
                        <span class="text-xs text-zinc-500">Podcast Network &bull; 2024–Present</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition-colors mb-3">Frontier Tech Daily</h3>
                    <p class="text-xs text-zinc-300 leading-relaxed mb-6">
                        Daily audio post-production, spectral repair, dynamic loudness normalization (-16 LUFS broadcast standard), and vocal polishing for a top-ranked technology news program.
                    </p>
                    <div class="flex flex-wrap gap-2 text-[11px] font-mono text-zinc-400">
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">iZotope RX</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">LUFS Mastering</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Spectral De-Noise</span>
                        <span class="px-2.5 py-1 rounded bg-zinc-800/80">Rapid Turnaround</span>
                    </div>
                </div>
                <div class="p-6 bg-zinc-950/70 border-t border-zinc-800 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 font-medium">250+ episodes mastered with zero downtime</span>
                    <a href="#contact" class="text-xs font-semibold text-amber-400 hover:text-amber-300 inline-flex items-center gap-1">
                        Case Study &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Host Section -->
<section id="about" class="py-20 border-t border-zinc-800/80 bg-zinc-900/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-72 h-72 sm:w-88 sm:h-88 rounded-3xl overflow-hidden bg-gradient-to-tr from-amber-600 via-orange-600 to-indigo-800 p-1 shadow-2xl">
                    <div class="w-full h-full rounded-3xl bg-zinc-950 flex flex-col items-center justify-center p-8 text-center relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/20 rounded-full blur-2xl"></div>
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 text-zinc-950 flex items-center justify-center font-extrabold text-3xl mb-4 shadow-xl">
                            MC
                        </div>
                        <h4 class="text-xl font-bold text-white">Marcus Chen</h4>
                        <p class="text-xs font-mono text-amber-400 mt-1">Host &bull; Audio Engineer &bull; Producer</p>
                        <p class="text-xs text-zinc-400 mt-3 leading-relaxed">
                            "Great sound isn't just about high fidelity — it's about intimacy, presence, and storytelling that resonates long after the headphone is removed."
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">MEET THE PRODUCER</div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-6">
                    A Passion for Precision, Silence, &amp; Resonant Narrative
                </h2>
                <div class="space-y-4 text-sm text-zinc-300 leading-relaxed">
                    <p>
                        With over 15 years in broadcast audio, commercial sound design, and narrative production, Marcus founded <strong class="text-white">Listening Common</strong> to bridge the gap between creative technology and audio storytelling.
                    </p>
                    <p>
                        Having produced shows heard by millions across the globe, his philosophy centers on meticulous microphone technique, respect for dynamic range, and pushing spatial audio technology into new creative territories.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-6 mt-6 border-t border-zinc-800 text-left">
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase">Based In</span>
                        <span class="text-sm font-semibold text-white">San Francisco, CA</span>
                    </div>
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase">Specialization</span>
                        <span class="text-sm font-semibold text-white">Spatial &amp; Broadcast Audio</span>
                    </div>
                    <div>
                        <span class="text-xs text-zinc-500 block uppercase">Available For</span>
                        <span class="text-sm font-semibold text-white">Consulting &amp; Keynotes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Studio Gear Section -->
<section id="studio" class="py-20 border-t border-zinc-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">ACOUSTICS &amp; HARDWARE</div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">The Studio Gear Rack</h2>
            <p class="text-xs sm:text-sm text-zinc-400 mt-2">The analog warmth and digital fidelity behind every broadcast and production session.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl bg-zinc-900/60 border border-zinc-800/80 hover:border-zinc-700 transition-all">
                <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold text-sm mb-4">
                    MIC
                </div>
                <h4 class="text-base font-bold text-white mb-1">Microphones</h4>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Shure SM7B, Neumann U87 Ai, Sennheiser MKH 416 shotgun, and matched pair of Schoeps Colette MK4 for acoustic captures.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-zinc-900/60 border border-zinc-800/80 hover:border-zinc-700 transition-all">
                <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-sm mb-4">
                    PRE
                </div>
                <h4 class="text-base font-bold text-white mb-1">Preamps &amp; DSP</h4>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Universal Audio Apollo x8p interface with DSP Unison preamps, Rupert Neve Portico II Channel, and Burl Mothership conversion.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-zinc-900/60 border border-zinc-800/80 hover:border-zinc-700 transition-all">
                <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-sm mb-4">
                    MON
                </div>
                <h4 class="text-base font-bold text-white mb-1">Monitoring</h4>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Genelec 8330A SAM smart active studio monitors with GLM room calibration, Sennheiser HD650, and Audeze LCD-X reference headphones.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-zinc-900/60 border border-zinc-800/80 hover:border-zinc-700 transition-all">
                <div class="w-10 h-10 rounded-lg bg-violet-500/10 text-violet-400 flex items-center justify-center font-bold text-sm mb-4">
                    DAW
                </div>
                <h4 class="text-base font-bold text-white mb-1">Software &amp; Post</h4>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Pro Tools Ultimate, Ableton Live 12 Suite, iZotope RX 11 Advanced, FabFilter Pro-Q3, Soundtoys 5, and Dolby Atmos Production Suite.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact & Booking Section -->
<section id="contact" class="py-20 border-t border-zinc-800/80 bg-zinc-900/40 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-zinc-950 border border-zinc-800 p-8 sm:p-12 shadow-2xl relative overflow-hidden">
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl"></div>

            <div class="text-center max-w-xl mx-auto mb-10">
                <div class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">CONNECT WITH US</div>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Pitch an Episode or Book Studio Services</h2>
                <p class="text-xs sm:text-sm text-zinc-400 mt-2">Have a breakthrough audio research topic or need world-class podcast mixing? Get in touch.</p>
            </div>

            <form onsubmit="event.preventDefault(); alert('Message sent! Marcus and the Listening Common team will get back to you shortly.');" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-zinc-300 mb-1.5">Your Name</label>
                        <input type="text" required placeholder="Jane Doe" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-800 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-zinc-300 mb-1.5">Email Address</label>
                        <input type="email" required placeholder="jane@example.com" class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-800 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-500 transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-300 mb-1.5">Inquiry Type</label>
                    <select class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-800 text-sm text-white focus:outline-none focus:border-amber-500 transition-colors">
                        <option>Guest Pitch / Episode Proposal</option>
                        <option>Podcast Production &amp; Sound Design Commission</option>
                        <option>Sonic Branding &amp; Audio Identity Consultation</option>
                        <option>Sponsorship &amp; Partnership Opportunities</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-300 mb-1.5">Message / Project Details</label>
                    <textarea rows="4" required placeholder="Tell us about your project, timeline, or guest idea..." class="w-full px-4 py-2.5 rounded-xl bg-zinc-900 border border-zinc-800 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-500 transition-colors resize-none"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl font-bold text-sm bg-amber-500 hover:bg-amber-400 text-zinc-950 transition-all shadow-lg shadow-amber-500/20 cursor-pointer">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
