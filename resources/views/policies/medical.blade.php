@extends('layouts.app')

@section('title', 'Medical & Mental Health Disclaimer — The Listening Commons')
@section('meta_description', 'Important health and clinical educational disclaimer for dialogues hosted on The Listening Commons.')

@section('content')
<div class="py-16 sm:py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-12 border-b border-[#223468]/60 pb-8">
        <span class="text-xs font-mono font-bold uppercase tracking-widest text-[#2DD4BF] block mb-2">Notice</span>
        <h1 class="font-serif text-4xl sm:text-5xl font-bold text-white mb-4">Medical &amp; Mental Health Disclaimer</h1>
        <p class="text-sm text-zinc-400">Please read this disclaimer regarding medical, psychological, and psychiatric discussions on this platform.</p>
    </div>

    <div class="space-y-8 text-zinc-300 font-sans text-sm sm:text-base leading-relaxed">
        <div class="card-editorial p-8 rounded-2xl border-l-4 border-l-[#2DD4BF]">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">Educational &amp; Philosophical Content Only</h2>
            <p>
                The conversations, articles, transcripts, audio recordings, and visual productions presented on <em>The Listening Commons</em> (including interviews with clinical psychologists, psychiatrists, and medical professionals) are strictly for informational, cultural, and educational purposes. They do NOT constitute clinical medical advice, psychiatric diagnosis, or treatment recommendations.
            </p>
        </div>

        <div class="card-editorial p-8 rounded-2xl">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">No Doctor-Patient Relationship</h2>
            <p>
                Listening to, viewing, or interacting with The Listening Commons does not establish a doctor-patient, therapist-client, or other healthcare professional relationship. Always seek the advice of a qualified healthcare provider or licensed mental health professional regarding any medical condition or psychiatric distress.
            </p>
        </div>

        <div class="card-editorial p-8 rounded-2xl bg-[#0F1730]">
            <h2 class="font-serif text-2xl font-bold text-[#F3EFE6] mb-3">Crisis Resources &amp; Support Helplines</h2>
            <p class="mb-4">If you or someone you know is experiencing severe distress or thoughts of self-harm, please reach out immediately to emergency services or recognized crisis helplines:</p>
            <ul class="space-y-2 text-xs sm:text-sm text-zinc-300 font-mono">
                <li>&bull; India (KIRAN National Mental Health Helpline): <strong class="text-[#2DD4BF]">1800-599-0019</strong></li>
                <li>&bull; India (Tele-MANAS): <strong class="text-[#2DD4BF]">14416</strong> or <strong class="text-[#2DD4BF]">1800-891-4416</strong></li>
                <li>&bull; USA &amp; Canada: Call or text <strong class="text-[#2DD4BF]">988</strong> (Suicide &amp; Crisis Lifeline)</li>
                <li>&bull; United Kingdom: Call <strong class="text-[#2DD4BF]">111</strong> (NHS Mental Health Services)</li>
                <li>&bull; International: Contact your nearest emergency department or local crisis line.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
