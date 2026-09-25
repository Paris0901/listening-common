@extends('layouts.app')

@section('title', $guest->name . ' — Guest Profile | The Listening Commons')
@section('meta_description', Str::limit(strip_tags($guest->bio), 155))
@section('canonical', url('/guests/' . $guest->slug))
@section('og_image', $guest->photo_url)

@section('schema')
<script type="application/ld+json">
{
  "{{ '@context' }}": "https://schema.org",
  "{{ '@type' }}": "Person",
  "name": "{{ addslashes($guest->name) }}",
  "jobTitle": "{{ addslashes($guest->designation) }}",
  "worksFor": {
    "{{ '@type' }}": "Organization",
    "name": "{{ addslashes($guest->affiliation) }}"
  },
  "description": "{{ addslashes(Str::limit(strip_tags($guest->bio), 250)) }}",
  "image": "{{ $guest->photo_url }}",
  @if($guest->website_url)
  "url": "{{ $guest->website_url }}",
  @endif
  "sameAs": [
    "{{ url('/guests/' . $guest->slug) }}"
  ]
}
</script>
@endsection

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Guest Profile Header Card -->
        <div class="card-editorial p-8 sm:p-12 rounded-3xl mb-16 flex flex-col md:flex-row items-start md:items-center gap-8">
            <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-3xl overflow-hidden bg-zinc-800 border-2 border-[#2DD4BF] shrink-0 shadow-xl shadow-[#2DD4BF]/15">
                <img src="{{ $guest->photo_url }}" alt="{{ $guest->name }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-1 font-mono">GUEST ARCHIVE</span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#F3EFE6] mb-2">{{ $guest->name }}</h1>
                <p class="text-sm font-semibold text-[#2DD4BF] mb-4 font-mono">{{ $guest->designation }} &bull; {{ $guest->affiliation }}</p>
                <p class="text-xs sm:text-sm text-zinc-300 leading-relaxed font-normal mb-6">
                    {{ $guest->bio }}
                </p>
                @if($guest->website_url)
                <div class="flex items-center gap-4 text-xs font-semibold text-[#2DD4BF]">
                    <a href="{{ $guest->website_url }}" target="_blank" rel="noopener" class="hover:text-[#5EEAD4] transition-colors underline font-mono">Official Website &rarr;</a>
                </div>
                @endif
            </div>
        </div>

        <!-- Connected Episodes Section -->
        <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-6 border-b border-[#172346] pb-3">
            Conversations with {{ $guest->name }}
        </h2>

        <div class="space-y-6">
            @forelse($episodes as $ep)
            <article class="card-editorial p-6 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 text-xs font-mono text-zinc-400 mb-2">
                        <span class="font-bold text-[#2DD4BF]">EPISODE #{{ $ep->episode_number }}</span>
                        <span>&bull;</span>
                        <span>{{ $ep->formatted_duration ?? '50:00' }}</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#F3EFE6] hover:text-[#2DD4BF] transition-colors mb-2">
                        <a href="{{ route('episodes.show', $ep->slug) }}">{{ $ep->title }}</a>
                    </h3>
                    <p class="text-xs text-zinc-400 line-clamp-2 leading-relaxed">
                        {{ $ep->short_description }}
                    </p>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto shrink-0">
                    <button type="button" class="play-track-btn w-10 h-10 rounded-full bg-[#172346] hover:bg-[#2DD4BF] text-[#2DD4BF] hover:text-[#070B16] flex items-center justify-center transition-colors shadow cursor-pointer active:scale-95"
                        data-title="{{ $ep->title }}"
                        data-guest="{{ $guest->name }}"
                        data-duration="{{ $ep->formatted_duration ?? '50:00' }}"
                        data-cover="{{ $ep->artwork_url }}"
                        data-audio="{{ $ep->audio_url }}">
                        <svg class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                    <a href="{{ route('episodes.show', $ep->slug) }}" class="px-4 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider bg-[#0C1226] hover:bg-[#111A33] text-[#F3EFE6] border border-[#223468] transition-colors">
                        Show Notes
                    </a>
                </div>
            </article>
            @empty
            <div class="p-8 rounded-2xl card-editorial text-center text-zinc-400">
                <p>No published conversations currently associated with this profile.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
