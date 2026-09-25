<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden w-full max-w-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    
    <!-- Primary SEO Metadata -->
    <title>@yield('title', 'The Listening Commons — Where conversations become common ground')</title>
    <meta name="description" content="@yield('meta_description', 'The Listening Commons — Where conversations become common ground. An unhurried sanctuary for deep inquiry into mental health, human dignity, peace, gender, culture, AI, and lived experience.')">
    <meta name="keywords" content="@yield('keywords', 'The Listening Commons, podcast, human dignity, mental health, psychiatry, peace and reconciliation, restorative justice, ethical AI, storytelling, Scott Douglas Jacobsen, Dr Aninda Sidhana')">
    <meta name="author" content="Scott Douglas Jacobsen, Dr. Aninda Sidhana">
    <meta name="publisher" content="The Listening Commons">
    <meta name="copyright" content="The Listening Commons">
    <meta name="robots" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <meta name="googlebot" content="@yield('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Vector Favicon & Web App Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#080B11">
    <meta name="color-scheme" content="dark">
    <meta name="apple-mobile-web-app-title" content="Listening Commons">
    <meta name="application-name" content="The Listening Commons">

    <!-- OpenGraph Metadata -->
    <meta property="og:site_name" content="The Listening Commons">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="@yield('title', 'The Listening Commons — Where conversations become common ground')">
    <meta property="og:description" content="@yield('meta_description', 'Where conversations become common ground. An unhurried sanctuary for deep inquiry.')">
    <meta property="og:image" content="@yield('og_image', asset('favicon.svg'))">
    <meta property="og:image:alt" content="The Listening Commons Emblem">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@listeningcommon">
    <meta name="twitter:creator" content="@listeningcommon">
    <meta name="twitter:title" content="@yield('title', 'The Listening Commons')">
    <meta name="twitter:description" content="@yield('meta_description', 'Where conversations become common ground.')">
    <meta name="twitter:image" content="@yield('og_image', asset('favicon.svg'))">
    <meta name="twitter:image:alt" content="The Listening Commons">

    <!-- Single Master RSS Feed Discovery (Spotify / Anchor) -->
    <link rel="alternate" type="application/rss+xml" title="The Listening Commons Master Podcast Feed" href="{{ route('feed.podcast') }}">

    <!-- Google Fonts Preconnect & Exact Typography from Reference D:\website -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Global Base Schema.org JSON-LD Graph -->
    <script type="application/ld+json">
    {
      "{{ '@context' }}": "https://schema.org",
      "{{ '@graph' }}": [
        {
          "{{ '@type' }}": "Organization",
          "{{ '@id' }}": "{{ url('/') }}#organization",
          "name": "The Listening Commons",
          "url": "{{ url('/') }}",
          "logo": {
            "{{ '@type' }}": "ImageObject",
            "url": "{{ asset('favicon.svg') }}",
            "width": "128",
            "height": "128"
          },
          "founder": [
            {
              "{{ '@type' }}": "Person",
              "name": "Scott Douglas Jacobsen",
              "jobTitle": "Founder & Journalist",
              "sameAs": "https://in-sightpublishing.com/"
            },
            {
              "{{ '@type' }}": "Person",
              "name": "Dr. Aninda Sidhana",
              "jobTitle": "Co-Creator & Psychiatrist",
              "sameAs": "https://www.dranindasidhana.com/"
            }
          ],
          "description": "An independent dialogue initiative and unhurried sanctuary for deep inquiry into mental peace, human dignity, restorative justice, ethical technology, and lived experience."
        },
        {
          "{{ '@type' }}": "WebSite",
          "{{ '@id' }}": "{{ url('/') }}#website",
          "url": "{{ url('/') }}",
          "name": "The Listening Commons",
          "publisher": {
            "{{ '@id' }}": "{{ url('/') }}#organization"
          },
          "potentialAction": {
            "{{ '@type' }}": "SearchAction",
            "target": {
              "{{ '@type' }}": "EntryPoint",
              "urlTemplate": "{{ url('/episodes') }}?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          }
        },
        {
          "{{ '@type' }}": "PodcastSeries",
          "{{ '@id' }}": "{{ url('/') }}#podcast",
          "name": "The Listening Commons",
          "url": "{{ url('/') }}",
          "description": "Where conversations become common ground. An unhurried sanctuary for deep inquiry into mental health, human dignity, peace, and lived experience.",
          "webFeed": "{{ config('podcast.spotify_rss_url', 'https://anchor.fm/s/116518364/podcast/rss') }}",
          "author": {
            "{{ '@id' }}": "{{ url('/') }}#organization"
          }
        }
      ]
    }
    </script>

    <!-- Page Specific Schema (PodcastEpisode, Person, Article) -->
    @yield('schema')

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $activeFontPreset = \App\Models\Setting::get('site_font_preset', 'editorial');
        $fontStyles = [
            'editorial' => [
                'serif' => "'Fraunces', 'Newsreader', Georgia, serif",
                'display' => "'Fraunces', Georgia, serif",
                'sans' => "'Outfit', 'Plus Jakarta Sans', sans-serif",
            ],
            'literary' => [
                'serif' => "'Cormorant Garamond', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Outfit', 'Inter', sans-serif",
            ],
            'scholarly' => [
                'serif' => "'Playfair Display', Georgia, serif",
                'display' => "'Playfair Display', Georgia, serif",
                'sans' => "'Outfit', 'Plus Jakarta Sans', sans-serif",
            ],
            'warm' => [
                'serif' => "'Lora', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Outfit', 'Plus Jakarta Sans', sans-serif",
            ],
            'modern' => [
                'serif' => "'Outfit', ui-sans-serif, sans-serif",
                'display' => "'Outfit', sans-serif",
                'sans' => "'Outfit', 'Inter', sans-serif",
            ],
        ];
        $selectedFont = $fontStyles[$activeFontPreset] ?? $fontStyles['editorial'];
    @endphp
    <style>
        :root {
            --font-serif: {!! $selectedFont['serif'] !!};
            --font-display: {!! $selectedFont['display'] !!};
            --font-sans: {!! $selectedFont['sans'] !!};
        }
    </style>
</head>
<body class="bg-[#0a1620] text-[#fdf8f6] antialiased aurora-canvas font-sans selection:bg-[#1fb8b8] selection:text-[#0a1620] min-h-screen flex flex-col overflow-x-hidden w-full max-w-full">
    <!-- EXACT REFERENCE AURORA DYNAMIC BACKGROUND (D:\website) -->
    <div class="aurora-fixed-bg" aria-hidden="true">
        <div class="aurora">
            <span class="a1"></span>
            <span class="a2"></span>
            <span class="a3"></span>
            <span class="a4"></span>
        </div>
        <div class="noise-overlay"></div>
    </div>

    <!-- Main Navigation Header (Exact Reference Architecture from D:\website) -->
    <header id="site-header" class="site-nav">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-3 sm:gap-4 py-3 sm:py-4">
            
            <!-- Left: Brand Identity (Fraunces serif with glowing italic accent) -->
            <a href="{{ route('home') }}" class="n-brand tracking-wider uppercase group shrink-0" title="The Listening Commons">
                <span class="sr-only">THE LISTENING COMMONS</span>
                THE LISTENING <span>COMMONS</span>
            </a>

            <!-- Center: Clean Typographic Navigation Links (Unboxed, elegant spacing matching D:\website) -->
            <ul class="n-links hidden lg:flex items-center">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                </li>
                <li>
                    <a href="{{ route('episodes.index') }}" class="{{ request()->routeIs('episodes.*') || request()->routeIs('conversations.*') ? 'active' : '' }}">Conversations</a>
                </li>
                <li>
                    <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') || request()->routeIs('essays.*') ? 'active' : '' }}">Essays</a>
                </li>
                <li>
                    <a href="{{ route('newsletter') }}" class="{{ request()->routeIs('newsletter') ? 'active' : '' }}">Newsletter</a>
                </li>
                <li>
                    <a href="{{ route('collaborate') }}" class="{{ request()->routeIs('collaborate') ? 'active' : '' }}">Collaborate</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                </li>
            </ul>

            <!-- Right: Exact Gradient Pill CTA + Search + Hamburger -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <!-- Exact Gradient Pill CTA Button (D:\website n-book) -->
                <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="n-book hidden sm:inline-flex text-xs" title="Dr. Aninda Sidhana — Co-Creator & Clinical-Editorial Lead">
                    <span>Dr. Aninda Sidhana</span>
                    <span class="text-xs">&rarr;</span>
                </a>

                <!-- Minimalist Search Trigger -->
                <a href="{{ route('episodes.index') }}" aria-label="Open Search" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-[rgba(253,248,246,0.12)] bg-[#0f2230]/60 hover:bg-[#0f2230] text-[#fdf8f6]/80 hover:text-[#7fe3df] hover:border-[#1fb8b8] flex items-center justify-center transition-all active:scale-95 cursor-pointer shrink-0" title="Search Archive">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>

                <!-- Mobile Hamburger Toggle Button -->
                <button type="button" id="mobile-menu-toggle" aria-label="Open Navigation Menu" class="lg:hidden w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-[rgba(253,248,246,0.15)] bg-[#0f2230]/80 hover:bg-[#0f2230] text-[#fdf8f6] hover:text-[#7fe3df] hover:border-[#1fb8b8] flex items-center justify-center transition-all active:scale-95 cursor-pointer shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Side Drawer Navigation (Slide-Over with Backdrop Blur) -->
    <div id="mobile-drawer-backdrop" class="fixed inset-0 bg-black/80 backdrop-blur-md z-[10000] opacity-0 pointer-events-none transition-opacity duration-300" style="-webkit-backdrop-filter: blur(12px);"></div>

    <aside id="mobile-nav-drawer" aria-label="Mobile Navigation Drawer" class="fixed top-0 right-0 bottom-0 w-[85%] max-w-[340px] sm:max-w-[380px] h-[100dvh] z-[10001] bg-gradient-to-b from-[#0a1620] via-[#0f2230] to-[#070d17] border-l border-[rgba(253,248,246,0.12)] shadow-[-20px_0_50px_rgba(0,0,0,0.85)] flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] overflow-y-auto overscroll-contain">
        <!-- Drawer Top Bar -->
        <div class="p-4 sm:p-5 border-b border-[rgba(253,248,246,0.12)] flex items-center justify-between bg-[#0a1620]/90 shrink-0">
            <div class="flex items-center gap-2.5">
                <span class="w-7 h-7 border border-[#1fb8b8]/40 flex items-center justify-center font-display font-bold text-xs tracking-wider bg-[#0f2230] text-[#1fb8b8] shadow-sm">
                    LC
                </span>
                <span class="font-serif text-xs tracking-wider text-[#fdf8f6] font-medium uppercase">
                    The Listening Commons
                </span>
            </div>
            <button type="button" id="mobile-drawer-close" aria-label="Close Navigation" class="w-8 h-8 rounded-full bg-[#0f2230] border border-[rgba(253,248,246,0.15)] text-[#9a93a3] hover:text-[#7fe3df] hover:border-[#1fb8b8] flex items-center justify-center transition-all cursor-pointer active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Luxury Editorial Menu Items -->
        <div class="px-4 sm:px-6 py-5 flex-1 space-y-1 overflow-y-auto">
            <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-[#7fe3df] block mb-3 font-semibold">
                Curated Navigation
            </span>

            <nav class="space-y-1 font-sans">
                <!-- 01 Home -->
                <a href="{{ route('home') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('home') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Home</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 02 About -->
                <a href="{{ route('about') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('about') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">About the Commons</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 03 Conversations -->
                <a href="{{ route('episodes.index') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('episodes.*') || request()->routeIs('conversations.*') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Conversations</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 04 Essays & Reflections -->
                <a href="{{ route('articles.index') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('articles.*') || request()->routeIs('essays.*') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Essays &amp; Reflections</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 05 Letters / Newsletter -->
                <a href="{{ route('newsletter') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('newsletter') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Letters / Newsletter</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 06 Collaborate -->
                <a href="{{ route('collaborate') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('collaborate') || request()->routeIs('collaborations') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Collaborate</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>

                <!-- 07 Contact & Pitches -->
                <a href="{{ route('contact') }}" class="group flex items-center justify-between py-2.5 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-[#1fb8b8]/15 text-[#7fe3df] border border-[#1fb8b8]/40' : 'text-[#f6edf0] hover:text-[#fdf8f6] hover:bg-[#0f2230]' }}">
                    <span class="font-serif text-base tracking-tight font-normal">Contact &amp; Pitches</span>
                    <span class="text-xs text-[#9a93a3] group-hover:text-[#7fe3df] group-hover:translate-x-1 transition-all">&rarr;</span>
                </a>
            </nav>
        </div>

        <!-- Drawer Bottom: Dr. Aninda Sidhana Card -->
        <div class="p-4 sm:p-5 border-t border-[rgba(253,248,246,0.12)] bg-[#0a1620]/95 space-y-2.5 shrink-0">
            <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-[#0f2230] to-[#0a1620] border border-[#1fb8b8]/40 hover:border-[#1fb8b8] hover:shadow-[0_0_18px_rgba(31,184,184,0.3)] group transition-all duration-200 shadow-sm">
                <div class="flex items-center gap-2.5">
                    <span class="w-2 h-2 rounded-full bg-[#1fb8b8] group-hover:scale-125 transition-transform shadow-[0_0_6px_#1fb8b8]"></span>
                    <div class="flex flex-col">
                        <span class="font-serif text-xs font-medium text-[#fdf8f6] group-hover:text-[#7fe3df] transition-colors">Dr. Aninda Sidhana</span>
                        <span class="text-[10px] font-sans text-[#9a93a3]">Co-Creator &bull; dranindasidhana.com</span>
                    </div>
                </div>
                <span class="text-xs text-[#7fe3df] group-hover:translate-x-0.5 transition-transform">&rarr;</span>
            </a>

            <p class="text-[10px] font-serif italic text-center text-[#9a93a3]">
                Where conversations become common ground.
            </p>
        </div>
    </aside>

    <!-- Main Editorial Content Slot -->
    <main class="flex-1 relative z-10">
        @yield('content')
    </main>

    <!-- Global Audio Player Dock (Hidden until user actively plays an episode) -->
    <div id="audio-dock" class="bg-[#0a1620]/95 backdrop-blur-xl border-t border-[rgba(253,248,246,0.12)] text-[#fdf8f6] shadow-2xl">
        <!-- Native Audio Element for Real Streaming -->
        <audio id="master-podcast-player" preload="metadata" class="hidden"></audio>

        <!-- Top Micro Progress Bar on Mobile -->
        <div id="dock-progress-container-mobile" class="w-full h-1 bg-[#0f2230] cursor-pointer sm:hidden relative">
            <div id="dock-progress-bar-mobile" class="h-full bg-gradient-to-r from-[#1fb8b8] to-[#ef6b9c] w-[0%] transition-all duration-150"></div>
        </div>

        <div class="max-w-7xl mx-auto px-3 py-2 sm:px-6 sm:py-3.5 flex items-center justify-between gap-2.5 sm:gap-6">
            <!-- Left: Episode Info -->
            <div class="flex items-center gap-2 sm:gap-3.5 min-w-0 flex-1 sm:w-1/3">
                <div class="w-9 h-9 sm:w-11 sm:h-11 rounded-lg bg-[#0f2230] border border-[rgba(253,248,246,0.12)] overflow-hidden flex items-center justify-center text-[#7fe3df] shrink-0 font-serif font-bold text-xs sm:text-sm shadow-sm">
                    <span id="dock-cover-art" class="w-full h-full flex items-center justify-center">#1</span>
                </div>
                <div class="truncate min-w-0">
                    <h4 id="dock-title" class="text-xs sm:text-sm font-serif font-medium text-[#fdf8f6] truncate">The Sanctity of Attention</h4>
                    <p id="dock-subtitle" class="text-[10px] sm:text-xs text-[#9a93a3] truncate">The Listening Commons &bull; with Guest</p>
                </div>
            </div>

            <!-- Center: Player Controls & Desktop Scrubber -->
            <div class="flex items-center gap-3 sm:gap-5 shrink-0">
                <button id="dock-prev-btn" class="p-1 text-[#9a93a3] hover:text-[#7fe3df] transition-colors cursor-pointer" title="Rewind 15s">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24"><path d="M11 18V6l-8.5 6 8.5 6zm.5-6l8.5 6V6l-8.5 6z"/></svg>
                </button>
                <button id="dock-play-btn" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-r from-[#1fb8b8] to-[#ef6b9c] text-white flex items-center justify-center shadow-[0_0_18px_rgba(239,107,156,0.4)] hover:shadow-[0_0_24px_rgba(239,107,156,0.6)] transition-all active:scale-95 cursor-pointer shrink-0" title="Play / Pause">
                    <svg id="dock-play-icon" class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    <svg id="dock-pause-icon" class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current hidden" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                </button>
                <button id="dock-next-btn" class="p-1 text-[#9a93a3] hover:text-[#7fe3df] transition-colors cursor-pointer" title="Forward 30s">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24"><path d="M4 18l8.5-6L4 6v12zm9-12v12l8.5-6L13 6z"/></svg>
                </button>
            </div>

            <!-- Desktop Progress Bar & Times -->
            <div class="hidden md:flex flex-1 max-w-sm items-center gap-3 text-[11px] text-[#9a93a3] font-mono">
                <span id="dock-current-time">00:00</span>
                <div id="dock-progress-container" class="flex-1 h-1.5 bg-[#0f2230] rounded-full cursor-pointer overflow-hidden relative border border-[rgba(253,248,246,0.12)]">
                    <div id="dock-progress-bar" class="h-full bg-gradient-to-r from-[#1fb8b8] via-[#9b7fd4] to-[#ef6b9c] rounded-full w-[0%] transition-all duration-150"></div>
                </div>
                <span id="dock-total-time">57:00</span>
            </div>

            <!-- Right: Speed indicator, notes & Close Button -->
            <div class="flex items-center gap-2 text-xs text-[#9a93a3] justify-end shrink-0">
                <button type="button" id="dock-speed-btn" class="hidden lg:inline px-2 py-0.5 rounded bg-[#0f2230] border border-[rgba(253,248,246,0.12)] text-[#7fe3df] hover:border-[#1fb8b8] font-mono text-[10px] cursor-pointer" title="Change Playback Speed">1.0x</button>
                <a href="{{ route('episodes.index') }}" class="hidden md:inline hover:text-[#7fe3df] transition-colors text-xs font-mono">Show Notes &rarr;</a>
                <button type="button" id="dock-close-btn" class="p-1.5 rounded-lg text-[#9a93a3] hover:text-[#7fe3df] hover:bg-[#0f2230] transition-colors cursor-pointer" title="Hide Player">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Master Colophon Footer -->
    <footer class="bg-[#070d17] py-14 sm:py-16 text-[#fdf8f6] text-xs font-sans border-t border-[rgba(253,248,246,0.1)] relative z-10" data-purpose="literary-colophon-footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 pb-14 border-b border-[rgba(253,248,246,0.1)]">
                <!-- Brand & Mission Col (5 cols) -->
                <div class="md:col-span-5">
                    <div class="flex items-center space-x-2.5">
                        <span class="w-7 h-7 border border-[#1fb8b8]/40 text-[#7fe3df] flex items-center justify-center font-display text-[10px] font-bold bg-[#0f2230]">LC</span>
                        <span class="font-serif text-lg font-medium text-[#fdf8f6]">The Listening Commons</span>
                    </div>
                    <p class="mt-4 text-xs font-serif italic text-transparent bg-clip-text bg-gradient-to-r from-[#7fe3df] via-[#9b7fd4] to-[#ffb3d1] leading-relaxed max-w-sm">
                        &ldquo;Where conversations become common ground.&rdquo;
                    </p>
                    <p class="mt-3 text-xs text-[#9a93a3] leading-relaxed max-w-sm">
                        An independent digital publishing hub and audio documentary initiative dedicated to mental health, human dignity, peacebuilding, culture, and ethical storytelling.
                    </p>
                    <!-- Leadership Credits -->
                    <div class="mt-4 pt-4 border-t border-[rgba(253,248,246,0.1)] text-[11px] font-sans text-[#9a93a3] space-y-1">
                        <p><span class="text-[#fdf8f6] font-medium">Scott Douglas Jacobsen</span> &bull; Founder &amp; Creator</p>
                        <p><span class="text-[#fdf8f6] font-medium">Dr. Aninda Sidhana</span> &bull; Co-Creator &amp; Clinical–Editorial Lead &bull; <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="text-[#7fe3df] hover:underline">dranindasidhana.com &rarr;</a></p>
                    </div>
                </div>
    
                <!-- Publishing & Trust Links (3 cols) -->
                <div class="md:col-span-3">
                    <h5 class="text-[11px] font-mono uppercase tracking-[0.18em] text-[#7fe3df] font-bold">Publishing &amp; Trust</h5>
                    <ul class="mt-4 space-y-2.5 text-xs text-[#9a93a3]">
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('about') }}">About Us</a></li>
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('episodes.index') }}">Audio</a></li>
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('articles.index') }}">Essays</a></li>
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('newsletter') }}">Newsletter</a></li>
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('privacy') }}">Privacy</a></li>
                        <li><a class="hover:text-[#7fe3df] transition-colors" href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Colophon Rights -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-[11px] font-mono text-[#64748B]">
                <p>&copy; {{ date('Y') }} The Listening Commons. Canonical digital publication &bull; <a href="https://listeningcommons.com" class="text-[#94A3B8] hover:text-[#F8FAFC]">listeningcommons.com</a></p>
                <div class="flex items-center space-x-4 sm:space-x-6 mt-4 sm:mt-0">
                    <span>ISSN 2994-118X</span>
                    <span>&bull;</span>
                    <span>Open Audio Protocol</span>
                    <span>&bull;</span>
                    <a class="text-[#94A3B8] hover:text-[#2DD4BF] transition-colors" href="{{ route('privacy') }}">Privacy</a>
                    <span>&bull;</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Header scroll state
            const header = document.getElementById('site-header');
            if (header) {
                const onScroll = () => {
                    if (window.scrollY > 20) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                };
                window.addEventListener('scroll', onScroll, { passive: true });
                onScroll();
            }

            // Mobile Navigation Drawer Toggle & Slide-Over
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileNavDrawer = document.getElementById('mobile-nav-drawer');
            const mobileDrawerBackdrop = document.getElementById('mobile-drawer-backdrop');
            const mobileDrawerClose = document.getElementById('mobile-drawer-close');

            function openMobileDrawer() {
                if (!mobileNavDrawer || !mobileDrawerBackdrop) return;
                mobileDrawerBackdrop.classList.remove('opacity-0', 'pointer-events-none');
                mobileDrawerBackdrop.classList.add('opacity-100', 'pointer-events-auto');
                mobileNavDrawer.classList.remove('translate-x-full');
                mobileNavDrawer.classList.add('translate-x-0');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileDrawer() {
                if (!mobileNavDrawer || !mobileDrawerBackdrop) return;
                mobileDrawerBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
                mobileDrawerBackdrop.classList.add('opacity-0', 'pointer-events-none');
                mobileNavDrawer.classList.remove('translate-x-0');
                mobileNavDrawer.classList.add('translate-x-full');
                document.body.style.overflow = '';
            }

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openMobileDrawer();
                });
            }

            if (mobileDrawerClose) {
                mobileDrawerClose.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeMobileDrawer();
                });
            }

            if (mobileDrawerBackdrop) {
                mobileDrawerBackdrop.addEventListener('click', closeMobileDrawer);
            }

            if (mobileNavDrawer) {
                mobileNavDrawer.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', closeMobileDrawer);
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeMobileDrawer();
            });
        });
    </script>
</body>
</html>
