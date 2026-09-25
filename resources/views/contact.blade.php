@extends('layouts.app')

@section('title', 'Contact & Guest Proposals — The Listening Commons')
@section('meta_description', 'Pitch a guest, submit an inquiry, or discuss institutional partnership with Scott Douglas Jacobsen and Dr. Aninda Sidhana.')

@section('content')
<!-- BEGIN: ContactHeroSection -->
<section class="relative pt-10 sm:pt-14 pb-16 sm:pb-20 border-b border-[#1C263A] bg-gradient-to-b overflow-hidden" data-purpose="contact-hero">
    <!-- Luminous Ambient Background Glow -->
    <div class="absolute right-0 top-1/4 w-[20rem] sm:w-[30rem] h-[20rem] sm:h-[30rem] rounded-full bg-[#2DD4BF]/[0.04] blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute -left-20 top-1/2 w-80 h-80 rounded-full bg-blue-500/[0.02] blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Monastic Initiative Eyebrow Pill -->
        <div class="inline-flex items-center space-x-2.5 mb-6 sm:mb-8 px-3.5 py-1.5 rounded-full border border-[#2DD4BF]/30 bg-[#0E1420]/80">
            <span class="inline-block w-2 h-2 rounded-full bg-[#2DD4BF] shadow-[0_0_8px_#2DD4BF]"></span>
            <span class="text-[11px] font-sans uppercase tracking-[0.22em] text-[#2DD4BF] font-semibold">
                Inquiries &amp; Correspondence &bull; Reach the Commons
            </span>
        </div>

        <div class="max-w-3xl">
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-[3.75rem] leading-[1.14] text-[#F4F4F0] font-normal tracking-tight">
                Pitch an Episode or <span class="italic font-serif font-light text-[#2DD4BF] underline decoration-[#2DD4BF]/40 decoration-1 underline-offset-8">Connect</span>
            </h1>
            <p class="mt-5 font-serif italic text-base sm:text-xl text-[#2DD4BF]/90 font-light">
                &ldquo;A shared space for sustained inquiry across psychiatry, culture, art, and the human condition.&rdquo;
            </p>
            <p class="mt-4 font-serif text-sm sm:text-base text-[#E3E4DC] leading-relaxed font-light">
                We welcome recommendations for extraordinary thinkers, psychiatric researchers, clinicians, essayists, and institutional partners who cultivate human dignity, restorative attention, and common ground.
            </p>

            <!-- Metrics / Response Strip -->
            <div class="mt-8 pt-6 border-t border-[#1C263A] flex flex-wrap items-center gap-4 sm:gap-8 text-xs text-[#94A3B8] font-sans">
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Direct Review</strong> &mdash; Scott &amp; Dr. Sidhana</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">3–5 Business Days</strong> &mdash; Editorial Response</div>
                <span class="text-[#1C263A] hidden sm:inline">&bull;</span>
                <div><strong class="font-serif text-base sm:text-lg text-[#F4F4F0] font-normal">Strict Confidentiality</strong> &mdash; Ethical Intake</div>
            </div>
        </div>
    </div>
</section>
<!-- END: ContactHeroSection -->

<!-- BEGIN: Main Form & Editorial Guidance Columns -->
<section class="py-16 sm:py-20  border-b border-[#1C263A]" data-purpose="contact-form-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- Left Column: Inquiry Intake Form (7 cols) -->
            <div class="lg:col-span-7">
                <!-- Section Header -->
                <div class="pb-6 border-b border-[#1C263A] mb-8">
                    <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-1 font-semibold">Inquiry Intake</span>
                    <h2 class="font-serif text-2xl sm:text-3xl text-[#F4F4F0] font-normal">Submit Your Proposal</h2>
                    <p class="text-xs text-[#94A3B8] font-sans mt-1">Please provide clear context regarding your proposed dialogue, essay, or institutional partnership.</p>
                </div>

                <!-- Form Card -->
                <div class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-10 shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-transparent group-hover:bg-[#2DD4BF] transition-colors rounded-t-2xl"></div>

                    <form id="contact-form" onsubmit="event.preventDefault(); document.getElementById('contact-success-box').classList.remove('hidden'); this.classList.add('hidden');" class="space-y-6">
                        <!-- Name & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-name" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                    Your Full Name <span class="text-[10px] text-[#2DD4BF] uppercase font-bold tracking-widest">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="contact-name" 
                                    name="name" 
                                    required 
                                    placeholder="e.g. Elena Rostova" 
                                    class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] transition-colors"
                                >
                            </div>

                            <div>
                                <label for="contact-email" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                    Email Address <span class="text-[10px] text-[#2DD4BF] uppercase font-bold tracking-widest">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="contact-email" 
                                    name="email" 
                                    required 
                                    placeholder="elena@institution.org" 
                                    class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] transition-colors"
                                >
                            </div>
                        </div>

                        <!-- Organization & Reason for Inquiry (lc.txt exact match) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-org" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                    Organization <span class="text-[#64748B] normal-case tracking-normal">(optional)</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="contact-org" 
                                    name="organization" 
                                    placeholder="University, Foundation, or Independent" 
                                    class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] transition-colors"
                                >
                            </div>

                            <div>
                                <label for="contact-reason" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                    Reason for Inquiry <span class="text-[10px] text-[#2DD4BF] uppercase font-bold tracking-widest">*</span>
                                </label>
                                <select 
                                    id="contact-reason" 
                                    name="reason" 
                                    required 
                                    class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF] transition-colors cursor-pointer"
                                >
                                    <option value="Suggest a guest" {{ request('reason') === 'Suggest a guest' ? 'selected' : '' }}>Suggest a guest</option>
                                    <option value="Media" {{ request('reason') === 'Media' ? 'selected' : '' }}>Media &amp; Press</option>
                                    <option value="Partnership" {{ request('reason') === 'Partnership' ? 'selected' : '' }}>Partnership (Academic / NGO)</option>
                                    <option value="Collaboration" {{ request('reason') === 'Collaboration' ? 'selected' : '' }}>Collaboration (WICCI / Essay)</option>
                                    <option value="General inquiry" {{ request('reason') === 'General inquiry' ? 'selected' : '' }}>General inquiry</option>
                                </select>
                            </div>
                        </div>

                        <!-- Primary Thematic Pillar -->
                        <div>
                            <label for="contact-pillar" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                Primary Thematic Focus <span class="text-[#64748B] normal-case tracking-normal">(optional)</span>
                            </label>
                            <select 
                                id="contact-pillar" 
                                name="thematic_focus" 
                                class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF] transition-colors cursor-pointer"
                            >
                                <option value="">Select a primary domain...</option>
                                <option value="Mental Health & Healing">Mental Health &amp; Healing</option>
                                <option value="Human Dignity">Human Dignity</option>
                                <option value="Peace & Reconciliation">Peace &amp; Reconciliation (UNSCR 1325)</option>
                                <option value="Psychiatry & Psychosexual Medicine">Psychiatry &amp; Psychosexual Medicine</option>
                                <option value="Gender & Belonging">Gender &amp; Belonging</option>
                                <option value="AI & Humanity">AI &amp; Humanity</option>
                                <option value="Responsible Storytelling">Responsible Storytelling</option>
                                <option value="Culture & Lived Experience">Culture &amp; Lived Experience</option>
                            </select>
                        </div>

                        <!-- Message / Proposal Details -->
                        <div>
                            <label for="contact-message" class="block text-[11px] font-mono uppercase tracking-[0.18em] text-[#2DD4BF] font-semibold mb-2">
                                Proposal Details &amp; Perspective <span class="text-[10px] text-[#2DD4BF] uppercase font-bold tracking-widest">*</span>
                            </label>
                            <textarea 
                                id="contact-message" 
                                name="message" 
                                rows="5" 
                                required 
                                placeholder="Describe the background, publications, or lived experience of the proposed speaker/topic, and why this dialogue cultivates common ground..." 
                                class="w-full px-4 py-3 rounded-sm bg-[#080B11] border border-[#1C263A] text-xs font-sans text-[#F4F4F0] placeholder-[#5A6882] focus:outline-none focus:border-[#2DD4BF] transition-colors resize-none leading-relaxed"
                            ></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <button 
                                type="submit" 
                                class="px-8 py-3.5 rounded-sm bg-[#2DD4BF] hover:bg-[#14B8A6] text-[#080B11] font-sans font-semibold text-xs tracking-wider uppercase transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <span>Submit to Editorial Board</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>

                            <span class="text-[11px] font-mono text-[#64748B]">
                                Non-commercial &bull; Stored with care
                            </span>
                        </div>
                    </form>

                    <!-- Success State Box -->
                    <div id="contact-success-box" class="hidden text-center py-10 space-y-4 max-w-md mx-auto">
                        <div class="w-12 h-12 rounded-full border border-[#2DD4BF] text-[#2DD4BF] flex items-center justify-center mx-auto text-xl bg-[#0E1420]">
                            &check;
                        </div>
                        <h3 class="font-serif text-xl sm:text-2xl text-[#F4F4F0] font-normal">
                            Proposal Received
                        </h3>
                        <p class="font-serif italic text-sm text-[#2DD4BF]/90">
                            Thank you for reaching out to The Listening Commons.
                        </p>
                        <p class="text-xs text-[#94A3B8] font-sans leading-relaxed">
                            Your inquiry has been logged in our editorial registry. Scott Douglas Jacobsen and Dr. Aninda Sidhana review all incoming proposals against our curatorial standards.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Editorial Standards & Direct Access (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Section Header -->
                <div class="pb-6 border-b border-[#1C263A] mb-8">
                    <span class="text-[11px] font-mono tracking-[0.25em] uppercase text-[#2DD4BF] block mb-1 font-semibold">Curatorial Standards</span>
                    <h2 class="font-serif text-2xl sm:text-3xl text-[#F4F4F0] font-normal">How We Review</h2>
                    <p class="text-xs text-[#94A3B8] font-sans mt-1">Our criteria for guest selection and institutional partnerships.</p>
                </div>

                <!-- Review Criteria Card -->
                <article class="bg-[#101726] border border-[#1C263A] rounded-2xl p-6 sm:p-7 relative group hover:border-[#2DD4BF]/50 hover:bg-[#141D30] transition-all duration-300 shadow-xl">
                    <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#2DD4BF] block font-semibold mb-3">Editorial Review Framework</span>
                    <h3 class="font-serif text-lg font-medium text-[#F4F4F0] mb-3">Dignity, Depth &amp; Inviolable Respect</h3>
                    <ul class="space-y-3 font-serif text-xs text-[#94A3B8] leading-relaxed">
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#2DD4BF]">&bull;</span>
                            <span><strong>No Promotional Soundbites:</strong> We do not conduct promotional book tours or PR campaigns. Conversations are unhurried (45–90 min).</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#2DD4BF]">&bull;</span>
                            <span><strong>Lived &amp; Intellectual Rigour:</strong> We balance clinical depth and psychiatric insight with lived experience and cultural imagination.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-[#2DD4BF]">&bull;</span>
                            <span><strong>Verbatim Transcripts:</strong> Every conversation is permanently archived with open educational access and verified transcripts.</span>
                        </li>
                    </ul>
                </article>

                <!-- Reciprocal Brand Connections (Prompt 2, Item 2, 4 & 13) -->
                <div class="p-5 rounded-2xl border border-[#1C263A]/60 bg-[#06080D] space-y-3 text-xs font-sans">
                    <span class="text-[11px] font-mono uppercase tracking-wider text-[#2DD4BF] block font-semibold">Founding Portals</span>
                    <div class="space-y-2 text-[#94A3B8]">
                        <p class="flex items-center justify-between">
                            <span>Scott Douglas Jacobsen (Founder)</span>
                            <a href="https://in-sightpublishing.com/" target="_blank" rel="noopener" class="text-[#2DD4BF] hover:underline font-mono text-[11px]">in-sightpublishing.com &rarr;</a>
                        </p>
                        <p class="flex items-center justify-between">
                            <span>Dr. Aninda Sidhana (Co-Creator)</span>
                            <a href="https://www.dranindasidhana.com/" target="_blank" rel="noopener" class="text-[#2DD4BF] hover:underline font-mono text-[11px]">dranindasidhana.com &rarr;</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- END: Main Form & Editorial Guidance Columns -->
@endsection
