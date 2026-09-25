@extends('layouts.admin')

@section('title', 'Edit Episode #' . $episode->episode_number)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.episodes.index') }}" class="text-xs font-mono font-medium text-[#8E9BB0] hover:text-[#2DD4BF] mb-2 inline-flex items-center gap-1">
            <span>&larr; Back to Master Episodes</span>
        </a>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Edit Episode #{{ $episode->episode_number }}</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 font-mono">
            Canonical Episode Slug: <span class="text-[#2DD4BF]">/episodes/{{ $episode->slug }}</span>
        </p>
    </div>

    <form action="{{ route('admin.episodes.update', $episode->id) }}" method="POST" class="space-y-8 bg-[#0C1220] border border-[#1C263A] p-6 sm:p-10 rounded-xl shadow-2xl">
        @csrf
        @method('PUT')

        <!-- SECTION 1: Core Episode Details -->
        <div>
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] border-b border-[#1C263A] pb-2 mb-4 flex items-center justify-between">
                <span>1. Episode Metadata</span>
                <span class="text-xs font-mono text-[#2DD4BF]">Canonical Record</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Episode #</label>
                    <input type="number" name="episode_number" required value="{{ old('episode_number', $episode->episode_number) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono font-bold text-[#2DD4BF] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Episode Title</label>
                    <input type="text" name="title" required value="{{ old('title', $episode->title) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <!-- SECTION 2: Guest & Host Credits -->
        <div>
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] border-b border-[#1C263A] pb-2 mb-4">
                2. Guest &amp; Host Credits
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Featured Thinker / Guest</label>
                    <select name="guest_id" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                        @foreach($guests as $guest)
                        <option value="{{ $guest->id }}" {{ $episode->guest_id == $guest->id ? 'selected' : '' }}>
                            {{ $guest->name }} ({{ $guest->designation }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Host / Co-host Attribution</label>
                    <input type="text" name="host_names" value="{{ old('host_names', $episode->host_names ?? 'Scott Douglas Jacobsen & Dr. Aninda Sidhana') }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <!-- SECTION 3: Thematic Collections -->
        <div>
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] border-b border-[#1C263A] pb-2 mb-3">
                3. Thematic Collections
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @php
                    $currentThemeIds = $episode->themes ? $episode->themes->pluck('id')->toArray() : [];
                @endphp
                @foreach($themes as $theme)
                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#C5CEE0] hover:border-[#2DD4BF]/50 cursor-pointer">
                    <input type="checkbox" name="themes[]" value="{{ $theme->id }}" {{ in_array($theme->id, $currentThemeIds) ? 'checked' : '' }} class="accent-[#2DD4BF]">
                    <span>{{ $theme->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- SECTION 4: Descriptions & Transcript -->
        <div>
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] border-b border-[#1C263A] pb-2 mb-4">
                4. Narrative Content &amp; Verbatim Transcript
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Short Editorial Summary</label>
                    <textarea name="short_description" rows="3" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('short_description', $episode->short_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Full Show Notes (HTML Allowed)</label>
                    <textarea name="full_show_notes" rows="5" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('full_show_notes', $episode->full_show_notes) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Timestamped Verbatim Transcript</label>
                    <textarea name="transcript" rows="6" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('transcript', $episode->transcript) }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 5: Media Enclosures -->
        <div>
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] border-b border-[#1C263A] pb-2 mb-4">
                5. Media Enclosures &amp; Third-Party Platforms (Podbean / Spotify / Apple)
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Audio MP3 Stream / File URL</label>
                    <input type="url" name="audio_url" required value="{{ old('audio_url', $episode->audio_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Runtime (Seconds)</label>
                    <input type="number" name="audio_duration_seconds" value="{{ old('audio_duration_seconds', $episode->audio_duration_seconds) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">YouTube Video URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $episode->youtube_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Spotify Show URL</label>
                    <input type="url" name="spotify_url" value="{{ old('spotify_url', $episode->spotify_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Apple Podcasts URL</label>
                    <input type="url" name="apple_podcasts_url" value="{{ old('apple_podcasts_url', $episode->apple_podcasts_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Artwork / Cover Image URL</label>
                    <input type="url" name="artwork_url" value="{{ old('artwork_url', $episode->artwork_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <!-- SECTION 6: Status & Publication -->
        <div class="pt-4 border-t border-[#1C263A]">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer font-mono text-xs text-[#C5CEE0]">
                        <input type="checkbox" name="is_published" value="1" {{ $episode->is_published ? 'checked' : '' }} class="accent-[#2DD4BF] w-4 h-4">
                        <span>Published Publicly</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-mono text-xs text-[#C5CEE0]">
                        <input type="checkbox" name="is_featured" value="1" {{ $episode->is_featured ? 'checked' : '' }} class="accent-[#2DD4BF] w-4 h-4">
                        <span>Featured Hero Dialogue</span>
                    </label>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.episodes.index') }}" class="px-4 py-2.5 rounded-lg text-xs font-mono text-[#8E9BB0] hover:text-[#F4F4F0] border border-[#1C263A]">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg font-mono font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 cursor-pointer">
                        Update Episode &rarr;
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
