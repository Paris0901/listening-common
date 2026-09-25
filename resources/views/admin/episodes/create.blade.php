@extends('layouts.admin')

@section('title', 'Master Episode Entry')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.episodes.index') }}" class="text-xs font-semibold text-zinc-400 hover:text-[#2DD4BF] mb-2 inline-block font-mono">&larr; Back to Master Episodes</a>
        <h1 class="font-serif text-3xl font-bold text-[#F3EFE6]">New Master Episode Entry</h1>
        <p class="text-xs text-zinc-400 mt-1">
            "Publish Once &rarr; Update Everywhere" workflow: This single form populates the canonical website page, podcast RSS feed, guest directory, and generates multi-channel distribution drafts in the safety queue.
        </p>
    </div>

    <form action="{{ route('admin.episodes.store') }}" method="POST" class="space-y-8 card-editorial p-8 sm:p-10 rounded-2xl shadow-xl">
        @csrf

        <!-- SECTION 1: Core Episode Details -->
        <div>
            <h2 class="font-serif text-lg font-bold text-[#F3EFE6] border-b border-[#172346] pb-2 mb-4">
                1. Episode Metadata
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Episode #</label>
                    <input type="number" name="episode_number" required value="6" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs font-mono font-bold text-[#2DD4BF] focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Episode Title</label>
                    <input type="text" name="title" required placeholder="e.g. The Architecture of Narrative Hospitality" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <!-- SECTION 2: Guest & Host Credits -->
        <div>
            <h2 class="font-serif text-lg font-bold text-[#F3EFE6] border-b border-[#172346] pb-2 mb-4">
                2. Guest &amp; Host Credits
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Featured Guest</label>
                    <select name="guest_id" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                        @foreach($guests as $guest)
                        <option value="{{ $guest->id }}">{{ $guest->name }} ({{ $guest->designation }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Host / Co-host</label>
                    <input type="text" name="host_names" value="Scott Douglas Jacobsen &amp; The Listening Commons Team" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <!-- SECTION 3: Thematic Collections -->
        <div>
            <h2 class="font-serif text-lg font-bold text-[#F3EFE6] border-b border-[#172346] pb-2 mb-3">
                3. Thematic Collections (Auto-Sorting)
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($themes as $theme)
                <label class="flex items-center gap-2 p-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-zinc-300 hover:border-[#2DD4BF]/50 cursor-pointer">
                    <input type="checkbox" name="theme_ids[]" value="{{ $theme->id }}" class="accent-[#2DD4BF]">
                    <span>{{ $theme->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- SECTION 4: Descriptions & Transcript -->
        <div>
            <h2 class="font-serif text-lg font-bold text-[#F3EFE6] border-b border-[#172346] pb-2 mb-4">
                4. Narrative Content &amp; Verbatim Transcript
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Short Editorial Summary</label>
                    <textarea name="short_description" rows="2" required placeholder="A 2-3 sentence overview that appears on episode cards, social snippets, and podcast directories..." class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Full Canonical Show Notes (HTML Allowed)</label>
                    <textarea name="full_show_notes" rows="4" required placeholder="<h3>About this Conversation</h3><p>Comprehensive overview, key takeaways, and references...</p>" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs font-mono text-white focus:outline-none focus:border-[#2DD4BF]"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Timestamped Verbatim Transcript</label>
                    <textarea name="transcript" rows="5" placeholder="[00:00:00] Scott Douglas Jacobsen: Welcome to The Listening Commons...&#10;&#10;[00:01:15] Guest Name: Thank you Scott..." class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs font-mono text-white focus:outline-none focus:border-[#2DD4BF]"></textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 5: Media Enclosures -->
        <div>
            <h2 class="font-serif text-lg font-bold text-[#F3EFE6] border-b border-[#172346] pb-2 mb-4">
                5. Audio &amp; Video Enclosures (RSS &amp; YouTube)
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">MP3 Audio File URL</label>
                    <input type="url" name="audio_url" required placeholder="https://traffic.libsyn.com/secure/listeningcommons/ep.mp3" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Runtime (Seconds)</label>
                    <input type="number" name="audio_duration_seconds" value="3420" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs font-mono text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">YouTube URL (Optional)</label>
                    <input type="url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[#F3EFE6] mb-1 font-mono">Square Artwork URL</label>
                    <input type="url" name="artwork_url" value="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80" class="w-full px-3.5 py-2.5 rounded-lg bg-[#070B16] border border-[#223468] text-xs text-white focus:outline-none focus:border-[#2DD4BF]">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[#172346] flex items-center justify-between">
            <span class="text-xs text-zinc-400 font-mono">
                Safe Multi-Channel: Generates Substack, LinkedIn, YouTube, and Instagram drafts for review.
            </span>
            <button type="submit" class="px-8 py-3.5 rounded-lg font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#070B16] hover:brightness-110 transition-all shadow-lg shadow-[#2DD4BF]/25 cursor-pointer font-mono">
                Publish Master Episode &rarr;
            </button>
        </div>
    </form>
</div>
@endsection
