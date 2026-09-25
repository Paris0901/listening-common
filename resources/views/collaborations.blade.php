@extends('layouts.app')

@section('title', 'Collaborations & Institutional Partnerships — The Listening Commons')
@section('meta_description', 'Partner with The Listening Commons across guest conversations, essay submissions, academic initiatives, media collaborations, and WICCI council contributions.')

@section('content')
<!-- BEGIN: CollaborationsHeroSection -->
<section class="relative pt-10 sm:pt-14 pb-16 sm:pb-20 border-b border-[#1C263A] bg-gradient-to-b overflow-hidden" data-purpose="collaborations-hero">
    <!-- Luminous Ambient Background Glow -->
    <div class="absolute right-0 top-1/4 w-[20rem] sm:w-[30rem] h-[20rem] sm:h-[30rem] rounded-full bg-[#2DD4BF]/[0.04] blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute -left-20 top-1/2 w-80 h-80 rounded-full bg-blue-500/[0.02] blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Monastic Initiative Eyebrow Pill -->
        <div class="inline-flex items-center space-x-2.5 mb-6 sm:mb-8 px-3.5 py-1.5 rounded-full border border-[#2DD4BF]/30 bg-[#0E1420]/80">
            <span class="inline-block w-2 h-2 rounded-full bg-[#2DD4BF] shadow-[0_0_8px_#2DD4BF]"></span>
            <span class="text-[11px] font-sans uppercase tracking-[0.22em] text-[#2DD4BF] font-semibold">
                Institutional Alliances &bull; Collaborative Pathways
            </span>
        </div>

        <div class="max-w-3xl">
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-[3.75rem] leading-[1.14] text-[#F4F4F0] font-normal tracking-tight">
                Collaborations &amp; <span class="italic font-serif font-light text-[#2DD4BF] underline decoration-[#2DD4BF]/40 decoration-1 underline-offset-8">Institutional Alliances</span>
            </h1>
            <p class="mt-5 font-serif italic text-base sm:text-xl text-[#2DD4BF]/90 font-light">
                &ldquo;Where independent journalism meets psychiatric insight and cultural imagination.&rdquo;
            </p>
            <p class="mt-4 font-serif text-sm sm:text-base text-[#E3E4DC] leading-relaxed font-light">
                We partner with psychiatric societies, academic research departments, peacebuilding missions, and cultural foundations to build unhurried spaces for inquiry that resist haste, certainty, and easy conclusions.
            </p>

            <!-- Editorial Review Standard Callout (Prompt 2, Item 12) -->
            <div class="mt-6 p-4 rounded-sm border-l-2 border-[#2DD4BF] bg-[#0E1420] text-xs font-serif italic text-[#C5CEE0] leading-relaxed">
                &ldquo;Submissions and proposals are reviewed for intellectual relevance, human dignity, clinical accuracy, and alignment with the platform&rsquo;s core values.&rdquo;
            </div>

            <!-- Philosophical Metrics Strip -->
            <div class="mt-8 pt-6 border-t border-[#1C263A] flex flex-wrap items-center gap-4 sm:gap-8 text-xs text-[#94A3B8] font-sans">
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">7 Pathways</strong> &mdash; Structured Engagement</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Non-Commercial</strong> &mdash; Public Interest Alliances</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Verifiable Impact</strong> &mdash; Transcripts &amp; Archives</div>
            </div>
        </div>
    </div>
</section>
<!-- END: CollaborationsHeroSection -->

<!-- BEGIN: Pathways Grid Section (Prompt 2, Item 12) -->
<section class="py-16 sm:py-20 bg-[#080B11] border-b border-[#1C263A]" data-purpose="collaboration-pathways">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-6 sm:pb-8 border-b border-[#1C263A] gap-4 mb-12 sm:mb-16">
            <div>
                <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-1 font-semibold">Engagement Framework</span>
                <h2 class="font-serif text-2xl sm:text-4xl text-[#F4F4F0] font-normal">Seven Pathways for Collaboration</h2>
            </div>
            <div>
                <span class="text-xs uppercase tracking-widest font-mono text-[#94A3B8]">
                    Public Interest &bull; Editorial Intake
                </span>
            </div>
        </div>

        <!-- 7 Pathways Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            
            <!-- Pathway 01: Guest Conversations -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 01</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">01</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        Guest Conversations
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        Propose extraordinary thinkers, researchers, clinicians, artists, or persons of lived experience whose insights challenge conventional assumptions and deepen human dignity.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Suggest a guest']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>Nominate a Speaker</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 02: Essay Submissions -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 02</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">02</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        Essay Submissions
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        Submit original philosophical, clinical, or cultural reflections for publication in Reflections from the Commons. We welcome rigorous essays that resist polemic and cultivate insight.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Collaboration']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>Submit Proposal</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 03: Academic & Cultural Partnerships -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 03</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">03</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        Academic &amp; Cultural Partnerships
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        We collaborate with universities, bioethics institutes, research centers, and cultural archives to preserve oral histories, syllabus integrations, and open educational dialogues.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Partnership']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>Initiate Academic Alliance</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 04: Media Collaborations -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 04</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">04</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        Media Collaborations
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        Syndication, co-produced audio documentary series, and press interviews. We engage with responsible journalists and broadcast platforms dedicated to ethical narrative inquiry.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Media']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>Press &amp; Media Intake</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 05: Institutional Partnerships -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 05</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">05</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        Institutional Partnerships
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        Long-term alliances with psychiatric associations, conflict-resolution networks (including UNSCR 1325 dialogue architectures), and human-rights initiatives globally.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Partnership']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>Inquire About Alliances</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 06: WICCI Council Contributions -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-[#1C263A]">
                        <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 06</span>
                        <span class="w-7 h-7 rounded-full border border-[#1C263A] bg-[#0E1420] text-[#2DD4BF] flex items-center justify-center font-mono text-xs">06</span>
                    </div>
                    <h3 class="font-serif text-xl font-medium text-[#F4F4F0] mt-5 group-hover:text-[#2DD4BF] transition-colors">
                        WICCI Council Contributions
                    </h3>
                    <p class="mt-3 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed">
                        Contributions aligned with the WICCI National Psychosocial &amp; Mental Wellness Council: women&rsquo;s mental health, trauma-informed care, suicide reporting ethics, and dignity in public systems.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-[#1C263A]">
                    <a href="{{ route('contact', ['reason' => 'Collaboration']) }}" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center justify-between">
                        <span>WICCI Inquiries</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>

            <!-- Pathway 07: Sponsorship Enquiries -->
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-8 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl lg:col-span-3">
                <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    <div class="lg:col-span-8">
                        <div class="flex items-center space-x-3 pb-3 border-b border-[#1C263A]">
                            <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] font-semibold">Pathway 07</span>
                            <span class="text-xs font-mono text-[#94A3B8]">&bull; Mission-Aligned Underwriting</span>
                        </div>
                        <h3 class="font-serif text-xl sm:text-2xl font-medium text-[#F4F4F0] mt-4 group-hover:text-[#2DD4BF] transition-colors">
                            Sponsorship Enquiries &amp; Philanthropic Grants
                        </h3>
                        <p class="mt-2 font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed max-w-3xl">
                            We accept grants and institutional underwriting strictly aligned with our public charter: preserving open, commercial-free dialogues with zero corporate editorial interference.
                        </p>
                    </div>
                    <div class="lg:col-span-4 flex lg:justify-end">
                        <a href="{{ route('contact', ['reason' => 'Partnership']) }}" class="px-7 py-3.5 rounded-sm bg-[#2DD4BF] hover:bg-[#14B8A6] text-[#080B11] font-sans font-semibold text-xs tracking-wider uppercase transition-all shadow-md inline-flex items-center gap-2">
                            <span>Discuss Underwriting</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>
<!-- END: Pathways Grid Section -->

<!-- BEGIN: WICCI Institutional Collaboration Section (Prompt 2, Item 8) -->
<section class="py-16 sm:py-20 bg-[#06080D]" data-purpose="wicci-collaboration-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#101726] border border-[#1C263A] rounded-2xl p-8 sm:p-12 relative overflow-hidden shadow-2xl">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-[#2DD4BF]/[0.03] blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left: WICCI Identity & Details (8 cols) -->
                <div class="lg:col-span-8">
                    <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-2 font-semibold">
                        In Collaboration With
                    </span>
                    <h3 class="font-serif text-2xl sm:text-3xl text-[#F4F4F0] font-normal mb-2">
                        WICCI National Psychosocial &amp; Mental Wellness Council
                    </h3>
                    <p class="text-xs sm:text-sm font-serif italic text-[#2DD4BF]/90 mb-5">
                        Led by Dr. Aninda Sidhana, National President
                    </p>
                    <p class="font-serif text-xs sm:text-sm text-[#94A3B8] leading-relaxed max-w-2xl">
                        The collaboration advances responsible public conversations around mental health, psychosocial wellbeing, storytelling, inclusion, dignity and media ethics. It brings together clinical knowledge, cultural dialogue and public leadership to encourage narratives that deepen understanding rather than stigma.
                    </p>
                </div>

                <!-- Right: WICCI Seal & CTA (4 cols) -->
                <div class="lg:col-span-4 flex flex-col items-start lg:items-end justify-center gap-4">
                    <div class="px-5 py-4 rounded-xl bg-[#0E1420] border border-[#2DD4BF]/30 text-center w-full lg:w-auto">
                        <span class="font-display font-bold text-sm tracking-wider text-[#2DD4BF] block">WICCI</span>
                        <span class="text-[10px] font-mono text-[#94A3B8] block mt-0.5">National Council Alliance</span>
                    </div>
                    <a href="{{ route('contact', ['reason' => 'Collaboration']) }}" class="w-full lg:w-auto px-6 py-3 rounded-sm bg-[#0E1420] hover:bg-[#2DD4BF] hover:text-[#080B11] border border-[#1C263A] hover:border-[#2DD4BF] text-xs font-mono text-[#F4F4F0] transition-all text-center">
                        Propose WICCI Initiative &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: WICCI Institutional Collaboration Section -->
@endsection
