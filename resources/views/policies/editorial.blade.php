@extends('layouts.app')

@section('title', 'Editorial Policy — The Listening Commons')
@section('meta_description', 'The editorial principles, verification standards, and ethics governing dialogues on The Listening Commons.')

@section('content')
<div class="py-16 sm:py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-12 border-b border-[#223468]/60 pb-8">
        <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2">Governance &amp; Trust</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-white mb-4">Editorial Policy</h1>
        <p class="text-sm text-zinc-400">Guiding our dialogues with intellectual rigor, unhurried care, and deep respect for lived human experience.</p>
    </div>

    <div class="space-y-8 text-zinc-300 font-sans text-sm sm:text-base leading-relaxed">
        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">1. The Premise of Common Ground</h2>
            <p>
                The Listening Commons is dedicated to long-form inquiry across psychiatry, culture, consciousness, peacebuilding, and human dignity. We reject the premise that disagreement necessitates hostility. Our conversations seek the nuance between polarized extremes, offering speakers the time and safety to express complex thoughts without soundbite reductionism.
            </p>
        </div>

        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">2. Human-in-the-Loop &amp; AI Safety</h2>
            <p>
                While we leverage modern distribution tools, no artificial intelligence system is ever permitted to publish, misrepresent, or summarize dialogues autonomously. Every quotation, newsletter digest, and transcript excerpt is reviewed and approved by human editorial stewards. We categorically prohibit synthetic voice cloning or facial distortion of our guests and hosts.
            </p>
        </div>

        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">3. Attribution, Consent &amp; Integrity</h2>
            <p>
                Every episode is published with explicit guest authorization. Guests have access to review sensitive segments prior to syndication. We preserve permanent canonical archives on listeningcommons.com with timestamped, crawlable transcripts so that public conversation is transparent, searchable, and educational.
            </p>
        </div>
    </div>
</div>
@endsection
