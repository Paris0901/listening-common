@extends('layouts.admin')

@section('title', 'Editorial Inquiries & Newsletter Subscriptions')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
        <span class="text-[10px] font-mono uppercase tracking-widest text-[#2DD4BF] block mb-1">AUDIENCE &amp; COLLABORATIONS</span>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Letters &amp; Editorial Inquiries</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 max-w-2xl">
            Inbound guest pitches, institutional collaboration submissions (WICCI Council, In-Sight Publishing), and "Letters from The Listening Commons" newsletter subscribers.
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left 2 Cols: Inquiries & Pitches -->
    <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] flex items-center gap-2">
                <span>Inbound Inquiries &amp; Guest Proposals</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-[#2DD4BF]/20 text-[#2DD4BF] font-semibold border border-[#2DD4BF]/30">{{ count($inquiries) }}</span>
            </h2>
        </div>

        <div class="space-y-4">
            @foreach($inquiries as $inq)
            <div class="bg-[#0C1220] border border-[#1C263A] rounded-xl p-5 hover:border-[#2DD4BF]/40 transition-colors">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-[#1C263A]/60 pb-3 mb-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-display font-medium text-base text-[#F4F4F0]">{{ $inq->name }}</span>
                            <span class="text-xs font-mono text-[#8E9BB0]">&lt;{{ $inq->email }}&gt;</span>
                        </div>
                        <p class="text-xs text-[#2DD4BF] font-mono mt-0.5">{{ $inq->organization }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono uppercase tracking-wider bg-[#1C263A] text-[#C5CEE0] border border-[#1C263A]">
                            {{ $inq->type }}
                        </span>
                        <span class="text-[10px] font-mono text-[#8E9BB0]">{{ $inq->received_at->diffForHumans() }}</span>
                    </div>
                </div>

                <p class="text-xs text-[#C5CEE0] leading-relaxed font-sans mb-3">
                    {{ $inq->message }}
                </p>

                <div class="flex items-center justify-between text-xs font-mono pt-2 border-t border-[#1C263A]/40">
                    <span class="text-[11px] text-[#8E9BB0]">Status: <span class="text-[#2DD4BF]">{{ $inq->status }}</span></span>
                    <a href="mailto:{{ $inq->email }}?subject=The Listening Commons Editorial Reply" class="text-[#2DD4BF] hover:underline flex items-center gap-1">
                        <span>Reply Directly</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Right Col: Newsletter Subscribers -->
    <div class="space-y-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="font-display text-lg font-medium text-[#F4F4F0] flex items-center gap-2">
                <span>Letters Subscribers</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-emerald-950 text-emerald-400 font-semibold border border-emerald-800/40">Substack Connected</span>
            </h2>
        </div>

        <div class="bg-[#0C1220] border border-[#1C263A] rounded-xl p-5 shadow-xl">
            <div class="border-b border-[#1C263A]/80 pb-3 mb-4">
                <p class="text-xs font-mono text-[#2DD4BF] uppercase tracking-wider font-semibold">"Letters from The Listening Commons"</p>
                <p class="text-[11px] text-[#8E9BB0] mt-1">Native intake synced with Substack publication.</p>
            </div>

            <div class="divide-y divide-[#1C263A]/60">
                @foreach($subscribers as $sub)
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <span class="font-mono text-xs text-[#F4F4F0] block truncate max-w-[200px]">{{ $sub->email }}</span>
                        <span class="text-[10px] text-[#8E9BB0] font-mono">{{ $sub->source }}</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-mono uppercase bg-emerald-950/80 text-emerald-300 border border-emerald-800/50">
                        {{ $sub->status }}
                    </span>
                </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-[#1C263A] text-center">
                <a href="https://listeningcommons.substack.com" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-mono text-[#2DD4BF] hover:underline">
                    <span>Manage on Substack Dashboard &rarr;</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
