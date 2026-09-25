@extends('layouts.app')

@section('title', 'Voices of Common Ground & Guests Archive — The Listening Commons')
@section('meta_description', 'Meet the clinicians, peacemakers, philosophers, and essayists featured on The Listening Commons.')

@section('content')
<div class="py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-12">
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2">VOICES OF COMMON GROUND</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] leading-tight">
                Featured Thinkers &amp; Guests
            </h1>
            <p class="text-xs sm:text-sm text-zinc-400 mt-3 leading-relaxed">
                Our dialogues convene clinicians, jurists, cultural essayists, and lived experience advocates who bring profound nuance and courage to the public square.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($guests as $guest)
            <div class="card-editorial flex flex-col rounded-2xl p-6 text-center group">
                <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-2 border-[#2DD4BF] bg-zinc-800 shadow-lg shadow-[#2DD4BF]/15">
                    <img src="{{ $guest->photo_url }}" alt="{{ $guest->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <h2 class="font-serif text-lg font-bold text-[#F3EFE6] group-hover:text-[#2DD4BF] transition-colors">
                    <a href="{{ route('guests.show', $guest->slug) }}">{{ $guest->name }}</a>
                </h2>
                <p class="text-[11px] font-semibold text-[#2DD4BF] mt-1 mb-2 font-mono">{{ $guest->designation }}</p>
                <p class="text-xs text-zinc-400 line-clamp-3 leading-relaxed mb-6">
                    {{ $guest->bio }}
                </p>
                <div class="mt-auto pt-4 border-t border-[#172346] flex items-center justify-between text-xs text-zinc-300 font-semibold">
                    <span class="font-mono text-[11px] text-zinc-400">{{ $guest->episodes_count ?? 1 }} Dialogues</span>
                    <a href="{{ route('guests.show', $guest->slug) }}" class="text-[#2DD4BF] hover:text-[#5EEAD4] font-mono">&rarr; Profile</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
