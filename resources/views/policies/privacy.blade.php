@extends('layouts.app')

@section('title', 'Privacy Policy — The Listening Commons')
@section('meta_description', 'Our privacy standards, minimal tracking philosophy, and data protection policies.')

@section('content')
<div class="py-16 sm:py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-12 border-b border-[#223468]/60 pb-8">
        <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2">Privacy &amp; Data</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-white mb-4">Privacy Policy</h1>
        <p class="text-sm text-zinc-400">Respecting your intellectual privacy and digital dignity.</p>
    </div>

    <div class="space-y-8 text-zinc-300 font-sans text-sm sm:text-base leading-relaxed">
        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">Minimal Tracking Philosophy</h2>
            <p>
                The Listening Commons respects the sanctity of contemplation. We do not sell personal data, profile visitors for invasive behavioral advertising, or deploy invasive tracking pixels. Our analytics are strictly aggregate, first-party metrics measuring listener engagement and publication reach.
            </p>
        </div>

        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">Newsletter &amp; Communications</h2>
            <p>
                When you subscribe to our companion digest or submit an inquiry through our contact portal, your email address is used solely to deliver selected episodes, essays, and editorial updates. You may unsubscribe at any time with a single click.
            </p>
        </div>
    </div>
</div>
@endsection
