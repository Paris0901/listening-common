@extends('layouts.app')

@section('title', 'Letters from The Listening Commons — Editorial Correspondence')
@section('meta_description', 'Ideas worth sitting with. Conversations worth returning to. Receive new conversations, reflective essays, and ideas spanning psychiatry, culture, consciousness, and the human condition.')

@section('content')
<!-- BEGIN: NewsletterHeroSection -->
<section class="relative pt-10 sm:pt-14 pb-16 sm:pb-20 border-b border-[#1C263A] bg-gradient-to-b overflow-hidden" data-purpose="newsletter-hero">
    <!-- Luminous Ambient Background Glow -->
    <div class="absolute right-0 top-1/4 w-[20rem] sm:w-[30rem] h-[20rem] sm:h-[30rem] rounded-full bg-[#2DD4BF]/[0.04] blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute -left-20 top-1/2 w-80 h-80 rounded-full bg-blue-500/[0.02] blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Monastic Initiative Eyebrow Pill -->
        <div class="inline-flex items-center space-x-2.5 mb-6 sm:mb-8 px-3.5 py-1.5 rounded-full border border-[#2DD4BF]/30 bg-[#0E1420]/80">
            <span class="inline-block w-2 h-2 rounded-full bg-[#2DD4BF] shadow-[0_0_8px_#2DD4BF]"></span>
            <span class="text-[11px] font-sans uppercase tracking-[0.22em] text-[#2DD4BF] font-semibold">
                Editorial Correspondence &bull; The Letters
            </span>
        </div>

        <div class="max-w-3xl">
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-[3.75rem] leading-[1.14] text-[#F4F4F0] font-normal tracking-tight">
                Letters from <span class="italic font-serif font-light text-[#2DD4BF] underline decoration-[#2DD4BF]/40 decoration-1 underline-offset-8">The Listening Commons</span>
            </h1>
            <p class="mt-5 font-serif italic text-base sm:text-xl text-[#2DD4BF]/90 font-light">
                &ldquo;Ideas worth sitting with. Conversations worth returning to.&rdquo;
            </p>
            <p class="mt-4 font-serif text-sm sm:text-base text-[#E3E4DC] leading-relaxed font-light">
                Receive new conversations, reflective essays, and carefully selected ideas spanning psychiatry, culture, consciousness, science, art, and the human condition. Thoughtful correspondence&mdash;never noise.
            </p>

            <!-- Metrics / Protocol Strip -->
            <div class="mt-8 pt-6 border-t border-[#1C263A] flex flex-wrap items-center gap-4 sm:gap-8 text-xs text-[#94A3B8] font-sans">
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Occasional Frequency</strong> &mdash; Deep Reflections</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Substack Archive</strong> &mdash; Open Access</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Zero Spam</strong> &mdash; 100% Unsubscribable</div>
            </div>
        </div>
    </div>
</section>
<!-- END: NewsletterHeroSection -->

<!-- BEGIN: Archival Dispatches Section -->
<section class="py-16 sm:py-20 bg-[#06080D]" data-purpose="newsletter-archive-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-6 sm:pb-8 border-b border-[#1C263A] gap-4 mb-10 sm:mb-12">
            <div>
                <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-1 font-semibold">Archival Dispatches</span>
                <h2 class="font-serif text-2xl sm:text-4xl text-[#F4F4F0] font-normal">Recent Letters &amp; Reflections</h2>
            </div>
            <div>
                <span class="text-xs uppercase tracking-widest font-mono text-[#94A3B8]">
                    Selected Epistles &bull; Open Commons
                </span>
            </div>
        </div>

        <!-- Dynamic Letters Grid (Ingested from Substack) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($recentLetters ?? [] as $letter)
            <article class="bg-[#101726] border border-[#1C263A] rounded-2xl overflow-hidden p-6 sm:p-7 flex flex-col justify-between hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 relative group shadow-xl">
                <div>
                    @if($letter->cover_url)
                    <div class="aspect-[16/9] w-full overflow-hidden rounded-xl mb-5 bg-[#090D15] border border-[#1C263A]">
                        <img src="{{ $letter->cover_url }}" alt="{{ $letter->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @endif

                    <div class="flex items-center justify-between pb-3 border-b border-[#1C263A] text-[10px] font-mono uppercase tracking-wider text-[#94A3B8]">
                        <span class="text-[#2DD4BF] font-semibold">Substack Dispatch</span>
                        <span>{{ $letter->published_at ? $letter->published_at->format('M d, Y') : 'Recent' }}</span>
                    </div>

                    <h3 class="font-serif text-lg sm:text-xl font-medium text-[#F4F4F0] mt-4 group-hover:text-[#2DD4BF] transition-colors line-clamp-2">
                        <a href="{{ $letter->substack_url ?? '#' }}" target="_blank" rel="noopener">
                            {{ $letter->title }}
                        </a>
                    </h3>

                    <p class="mt-3 text-xs font-serif text-[#94A3B8] leading-relaxed line-clamp-3 italic">
                        &ldquo;{{ $letter->summary }}&rdquo;
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-[#1C263A] flex items-center justify-between text-xs">
                    <span class="text-[11px] font-sans text-[#64748B] truncate max-w-[150px]">{{ $letter->author_name }}</span>
                    <a href="{{ $letter->substack_url ?? '#' }}" target="_blank" rel="noopener" class="text-xs font-mono font-semibold uppercase tracking-wider text-[#2DD4BF] hover:underline flex items-center gap-1">
                        <span>Read Letter</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12 text-[#94A3B8] font-serif">
                <p>New letters from Substack are syncing...</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- END: Archival Dispatches Section -->
@endsection
