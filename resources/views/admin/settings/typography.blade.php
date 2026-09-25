@extends('layouts.admin')

@section('title', 'Website Typography & Appearance')

@section('content')
<div class="space-y-8 max-w-5xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-[#1C263A]">
        <div>
            <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] block mb-1 font-semibold">Visual Aesthetics &amp; Atmosphere</span>
            <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Typography &amp; Font Selection</h1>
            <p class="text-xs text-[#8E9BB0] mt-1 max-w-2xl">
                Choose the typographic personality for The Listening Commons. Changing this instantly updates headlines, pull quotes, and reading letters across the entire website.
            </p>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] hover:bg-[#141D30] text-xs font-mono transition-all shrink-0">
            <span>Preview Public Site</span>
            <span>&rarr;</span>
        </a>
    </div>

    <!-- Quick Sync Status Strip -->
    <div class="bg-[#0E1420] border border-[#1C263A] rounded-xl p-5 shadow-lg flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399]"></span>
                <span class="text-xs font-mono uppercase tracking-wider text-[#F4F4F0] font-semibold">Automated Cloud Feeds</span>
            </div>
            <p class="text-xs text-[#8E9BB0] mt-1">
                Your portal automatically imports podcasts from <strong>Spotify</strong> and written dispatches from <strong>Substack</strong>.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form action="{{ route('admin.settings.sync_spotify') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-[#101726] border border-[#1C263A] hover:border-[#2DD4BF]/60 text-xs font-mono text-[#F4F4F0] hover:text-[#2DD4BF] transition-colors cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-[#2DD4BF]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg>
                    <span>Sync Spotify ({{ $episodesCount }})</span>
                </button>
            </form>

            <form action="{{ route('admin.settings.sync_substack') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-[#101726] border border-[#1C263A] hover:border-[#2DD4BF]/60 text-xs font-mono text-[#F4F4F0] hover:text-[#2DD4BF] transition-colors cursor-pointer">
                    <svg class="w-3.5 h-3.5 text-[#FF6719]" fill="currentColor" viewBox="0 0 24 24"><path d="M22.539 8.242H1.46V5.406h21.08v2.836zM1.46 10.812V24L12 18.11 22.54 24V10.812H1.46zM22.54 0H1.46v2.836h21.08V0z"/></svg>
                    <span>Sync Substack ({{ $articlesCount }})</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Font Presets Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($presets as $key => $preset)
        @php
            $isActive = ($currentPreset === $key);
        @endphp
        <div class="bg-[#0C1220] border {{ $isActive ? 'border-[#2DD4BF] shadow-[0_0_25px_rgba(229,184,66,0.15)] ring-1 ring-[#2DD4BF]' : 'border-[#1C263A] hover:border-[#1C263A]/80' }} rounded-2xl p-6 sm:p-7 flex flex-col justify-between transition-all duration-300 relative overflow-hidden group">
            
            @if($isActive)
            <div class="absolute top-0 right-0 bg-[#2DD4BF] text-[#080B11] text-[10px] font-mono font-bold uppercase tracking-widest px-3 py-1 rounded-bl-xl shadow-md">
                Active Style
            </div>
            @endif

            <div>
                <!-- Preset Title & Badge -->
                <div class="flex items-center gap-2.5 mb-2">
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-[#1C263A] text-[#2DD4BF] font-semibold border border-[#2DD4BF]/20">
                        {{ $preset['badge'] }}
                    </span>
                </div>

                <h3 class="text-lg font-medium text-[#F4F4F0]">
                    {{ $preset['name'] }}
                </h3>
                <p class="text-xs text-[#8E9BB0] mt-1 leading-relaxed">
                    {{ $preset['description'] }}
                </p>

                <!-- Live Font Preview Box -->
                <div class="mt-5 p-4 rounded-xl bg-[#06080D] border border-[#1C263A] space-y-3">
                    <span class="text-[9px] font-mono uppercase tracking-[0.2em] text-[#64748B] block">Live Typographic Sample</span>
                    <h4 class="text-base font-medium text-[#F4F4F0] leading-snug" style="font-family: {{ $preset['serif'] }}">
                        The Architecture of Human Dignity
                    </h4>
                    <p class="text-xs text-[#2DD4BF]/90 italic leading-relaxed" style="font-family: {{ $preset['serif'] }}">
                        {{ $preset['sample'] }}
                    </p>
                    <p class="text-[11px] text-[#94A3B8] leading-relaxed pt-2 border-t border-[#1C263A]" style="font-family: {{ $preset['sans'] }}">
                        Attentive presence, survivor-informed inquiry, and ethical storytelling for psychiatric and public discourse.
                    </p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="mt-6 pt-4 border-t border-[#1C263A] flex items-center justify-between">
                <span class="text-[11px] font-mono text-[#64748B]">
                    Serif: {{ explode(',', $preset['serif'])[0] }}
                </span>

                @if($isActive)
                <span class="inline-flex items-center gap-1.5 text-xs font-mono font-semibold text-[#2DD4BF]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Currently Active</span>
                </span>
                @else
                <form action="{{ route('admin.settings.typography.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="preset" value="{{ $key }}">
                    <button type="submit" class="px-4 py-2 rounded-lg bg-[#2DD4BF] hover:bg-[#14B8A6] text-[#080B11] text-xs font-mono font-bold uppercase tracking-wider transition-all shadow-md cursor-pointer">
                        Select This Font
                    </button>
                </form>
                @endif
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection
