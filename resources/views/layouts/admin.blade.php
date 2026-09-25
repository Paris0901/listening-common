<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Editorial Publishing Hub') — The Listening Commons CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $activeFontPreset = \App\Models\Setting::get('site_font_preset', 'editorial');
        $fontStyles = [
            'editorial' => [
                'serif' => "'Newsreader', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
            ],
            'literary' => [
                'serif' => "'Cormorant Garamond', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Inter', sans-serif",
            ],
            'scholarly' => [
                'serif' => "'Playfair Display', Georgia, serif",
                'display' => "'Playfair Display', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
            ],
            'warm' => [
                'serif' => "'Lora', Georgia, serif",
                'display' => "'Cinzel', Georgia, serif",
                'sans' => "'Plus Jakarta Sans', sans-serif",
            ],
            'modern' => [
                'serif' => "'Plus Jakarta Sans', ui-sans-serif, sans-serif",
                'display' => "'Plus Jakarta Sans', sans-serif",
                'sans' => "'Inter', sans-serif",
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
<body class="bg-[#080B11] text-[#F4F4F0] font-sans antialiased h-full selection:bg-[#2DD4BF] selection:text-[#080B11]">

    <div class="h-full flex overflow-hidden bg-[#080B11]">
        
        <!-- Mobile Sidebar Backdrop Overlay -->
        <div id="sidebar-backdrop" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

        <!-- Admin Left Sidebar Navigation -->
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0A0E17] border-r border-[#1C263A] flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:static shrink-0">
            
            <!-- Sidebar Top: Brand & Monogram Seal -->
            <div class="flex flex-col">
                <div class="h-20 flex items-center justify-between px-6 border-b border-[#1C263A] bg-[#070B13]">
                    <a href="{{ route('admin.guests.index') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-lg border border-[#2DD4BF]/50 bg-[#0E1420] text-[#2DD4BF] font-display font-bold text-sm flex items-center justify-center shadow-lg shadow-black/40 group-hover:border-[#2DD4BF] transition-colors shrink-0">
                            LC
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-display font-medium text-sm tracking-tight text-[#F4F4F0] leading-none truncate">The Listening Commons</span>
                            <span class="text-[10px] font-mono text-[#2DD4BF] uppercase tracking-wider mt-1 font-semibold">Editorial CRM</span>
                        </div>
                    </a>

                    <!-- Mobile Close Button -->
                    <button type="button" id="close-sidebar-btn" class="lg:hidden text-[#8E9BB0] hover:text-[#F4F4F0] p-1.5 rounded-lg border border-[#1C263A] bg-[#06080D] cursor-pointer" aria-label="Close sidebar">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Streamlined Navigation for Non-Tech Client -->
                <nav class="p-4 space-y-6 overflow-y-auto max-h-[calc(100vh-220px)]">
                    
                    <!-- Section 1: Guest Profile Management (The ONLY Content Editing Area) -->
                    <div>
                        <span class="px-3 text-[10px] font-mono font-semibold uppercase tracking-[0.2em] text-[#5A6882] block mb-2">
                            Content Management
                        </span>
                        <div class="space-y-1">
                            <!-- Thinkers & Guest Profiles -->
                            <a href="{{ route('admin.guests.index') }}" 
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-mono transition-all {{ request()->routeIs('admin.guests.*') ? 'bg-[#1C263A] text-[#2DD4BF] font-semibold border-l-2 border-[#2DD4BF] shadow-md shadow-black/30' : 'text-[#8E9BB0] hover:text-[#F4F4F0] hover:bg-[#121826]' }}">
                                <svg class="w-4 h-4 shrink-0 {{ request()->routeIs('admin.guests.*') ? 'text-[#2DD4BF]' : 'text-[#8E9BB0]' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="truncate">Thinkers &amp; Guest Profiles</span>
                            </a>
                        </div>
                    </div>

                    <!-- Section 3: Cloud Feeds & Automated Sync -->
                    <div>
                        <span class="px-3 text-[10px] font-mono font-semibold uppercase tracking-[0.2em] text-[#5A6882] block mb-2">
                            Automated Feeds
                        </span>
                        <div class="p-3 rounded-xl bg-[#070B13] border border-[#1C263A] space-y-2.5 text-[11px] font-mono">
                            <div class="flex items-center justify-between text-[#8E9BB0]">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    <span>Spotify Podcasts</span>
                                </span>
                                <span class="text-[#2DD4BF]">{{ \App\Models\Episode::count() }} eps</span>
                            </div>
                            <div class="flex items-center justify-between text-[#8E9BB0]">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#FF6719]"></span>
                                    <span>Substack Letters</span>
                                </span>
                                <span class="text-[#2DD4BF]">{{ \App\Models\Article::count() }} letters</span>
                            </div>

                            <div class="pt-2 border-t border-[#1C263A] grid grid-cols-2 gap-1.5">
                                <form action="{{ route('admin.settings.sync_spotify') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-1 px-1.5 rounded bg-[#101726] hover:bg-[#141D30] text-[#8E9BB0] hover:text-[#2DD4BF] text-[10px] text-center border border-[#1C263A] transition-colors cursor-pointer">
                                        Sync Spotify
                                    </button>
                                </form>
                                <form action="{{ route('admin.settings.sync_substack') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-1 px-1.5 rounded bg-[#101726] hover:bg-[#141D30] text-[#8E9BB0] hover:text-[#2DD4BF] text-[10px] text-center border border-[#1C263A] transition-colors cursor-pointer">
                                        Sync Substack
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </nav>
            </div>

            <!-- Sidebar Bottom: Live Site Link & Authenticated Profile -->
            <div class="p-4 border-t border-[#1C263A] bg-[#070B13] space-y-3">

                <!-- User Profile & Direct Sign Out -->
                <div class="pt-2 border-t border-[#1C263A]/60 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-full bg-[#1C263A] border border-[#2DD4BF]/40 flex items-center justify-center font-display font-bold text-xs text-[#2DD4BF] shrink-0">
                            {{ strtoupper(substr(Auth::user()->name ?? 'SD', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <span class="text-xs font-mono font-semibold text-[#F4F4F0] block truncate">
                                {{ Auth::user()->name ?? 'Editorial Staff' }}
                            </span>
                            <span class="text-[10px] font-mono text-[#2DD4BF] block truncate">
                                {{ Auth::user()->email ?? 'admin@listeningcommons.com' }}
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                        @csrf
                        <button type="submit" title="Sign Out of CMS" class="p-2 rounded-lg text-[#8E9BB0] hover:text-red-400 hover:bg-red-950/30 border border-[#1C263A] hover:border-red-500/40 transition-colors cursor-pointer" aria-label="Sign Out">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Top Bar for Main Area -->
            <header class="h-16 lg:h-18 bg-[#0C1220] border-b border-[#1C263A] px-4 sm:px-8 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <!-- Hamburger Toggle for Mobile -->
                    <button type="button" id="open-sidebar-btn" class="lg:hidden p-2 rounded-lg text-[#8E9BB0] hover:text-[#F4F4F0] border border-[#1C263A] bg-[#0A0E17] cursor-pointer" aria-label="Open Navigation">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-2 truncate">
                        <span class="text-xs font-mono text-[#8E9BB0] uppercase tracking-wider hidden sm:inline">CMS &bull;</span>
                        <h1 class="font-display font-medium text-base sm:text-lg text-[#F4F4F0] truncate">@yield('title', 'Editorial Publishing Hub')</h1>
                    </div>
                </div>

                <!-- Top Bar Right: Status & Quick External Preview -->
                <div class="flex items-center gap-3 shrink-0">
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-mono uppercase bg-emerald-950/70 text-emerald-300 border border-emerald-800/50">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Editorial Session Active</span>
                    </span>
                    
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex sm:hidden p-2 rounded-lg border border-[#1C263A] text-[#2DD4BF]">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </header>

            <!-- Flash Notification Banners -->
            @if(session('success'))
            <div class="bg-[#0E1C1A] border-b border-[#22C55E]/40 text-[#86EFAC] px-6 py-2.5 text-xs font-mono font-medium flex items-center gap-2 shrink-0">
                <svg class="w-4 h-4 text-[#22C55E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-[#2A1116] border-b border-[#EF4444]/40 text-[#FCA5A5] px-6 py-2.5 text-xs font-mono font-medium flex items-center gap-2 shrink-0">
                <svg class="w-4 h-4 text-[#EF4444]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 lg:p-10 bg-[#080B11]">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>

                <!-- Footer in Main Content Area -->
                <footer class="mt-16 pt-6 border-t border-[#1C263A] text-xs text-[#5A6882] font-mono flex flex-col sm:flex-row items-center justify-between gap-2">
                    <span>The Listening Commons &bull; Confidential Editorial CMS</span>
                    <span>Founder &amp; Creator: Scott Douglas Jacobsen &bull; Co-Creator: Dr. Aninda Sidhana</span>
                </footer>
            </main>

        </div>
    </div>

    <!-- Script for Mobile Sidebar Drawer -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const openBtn = document.getElementById('open-sidebar-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');

            function openSidebar() {
                if (sidebar && backdrop) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                }
            }

            function closeSidebar() {
                if (sidebar && backdrop) {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }

            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>
