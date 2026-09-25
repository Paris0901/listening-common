@extends('layouts.app')

@section('title', 'Media & Press Kit — The Listening Commons')
@section('meta_description', 'Official press relations, media kit, institutional attribution facts, and interview requests for The Listening Commons.')

@section('content')
<div class="py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <span class="text-[11px] font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2 font-mono">PUBLIC ASSETS &amp; INQUIRIES</span>
            <h1 class="font-serif text-3xl sm:text-5xl font-bold text-[#F3EFE6] mb-3">Media &amp; Press Relations</h1>
            <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                Official press assets, institutional statements, host biography, and citation guidelines for journalists, cultural commentators, and scholars.
            </p>
        </div>

        <div class="space-y-6">
            <div class="card-editorial p-8 rounded-2xl shadow-xl">
                <h2 class="font-serif text-xl font-bold text-[#F3EFE6] mb-3">Fast Facts &amp; Attribution</h2>
                <ul class="space-y-2.5 text-xs text-zinc-300 font-mono">
                    <li><strong class="text-[#2DD4BF]">Canonical Entity:</strong> The Listening Commons</li>
                    <li><strong class="text-[#2DD4BF]">Tagline:</strong> Where conversations become common ground</li>
                    <li><strong class="text-[#2DD4BF]">Host:</strong> Scott Douglas Jacobsen</li>
                    <li><strong class="text-[#2DD4BF]">Format:</strong> Unhurried longform broadcast dialogues &amp; verbatim transcripts</li>
                    <li><strong class="text-[#2DD4BF]">Syndication:</strong> Podcast RSS 2.0, Spotify, Apple Podcasts, YouTube, Substack</li>
                    <li><strong class="text-[#2DD4BF]">Citation:</strong> <em>The Listening Commons</em> (Episode #, Guest Name, Canonical Title, Year)</li>
                </ul>
            </div>

            <div class="card-editorial p-8 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h2 class="font-serif text-xl font-bold text-[#F3EFE6] mb-1">Press Inquiries &amp; Interview Requests</h2>
                    <p class="text-xs text-zinc-400">Contact our media desk for embargoed broadcast access and transcript quotation licenses.</p>
                </div>
                <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#070B16] text-xs font-bold uppercase tracking-wider hover:brightness-110 transition-all font-mono">
                    Contact Media Desk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
