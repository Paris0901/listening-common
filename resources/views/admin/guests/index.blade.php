@extends('layouts.admin')

@section('title', 'Thinkers & Guest Pipeline CMS')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
        <span class="text-[10px] font-mono uppercase tracking-widest text-[#2DD4BF] block mb-1">VOICES &amp; PROFILES</span>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Thinkers &amp; Guest Profiles</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 max-w-2xl">
            Manage published thinker &amp; guest biographies, portraits, professional designations, and affiliations.
        </p>
    </div>

    <a href="{{ route('admin.guests.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] text-xs font-mono font-bold uppercase tracking-wider hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 shrink-0 cursor-pointer">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Add Guest Profile</span>
    </a>
</div>

<div class="bg-[#0C1220] border border-[#1C263A] rounded-xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-[#F4F4F0]">
            <thead class="bg-[#06080D] border-b border-[#1C263A] text-[11px] font-mono font-medium uppercase tracking-wider text-[#8E9BB0]">
                <tr>
                    <th class="py-3.5 px-5">Thinker / Guest</th>
                    <th class="py-3.5 px-5">Designation &amp; Focus</th>
                    <th class="py-3.5 px-5">Affiliation</th>
                    <th class="py-3.5 px-5">Conversations</th>
                    <th class="py-3.5 px-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1C263A]/70">
                @forelse($guests as $g)
                <tr class="hover:bg-[#121A2B]/50 transition-colors">
                    <td class="py-4 px-5">
                        <div class="flex items-center gap-3">
                            <img src="{{ $g->photo_url ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80' }}" alt="{{ $g->name }}" class="w-10 h-10 rounded-full object-cover border border-[#1C263A] shrink-0">
                            <div>
                                <span class="font-display font-medium text-sm text-[#F4F4F0] block">{{ $g->name }}</span>
                                <span class="text-[11px] text-[#8E9BB0] font-mono">/guests/{{ $g->slug }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-5 max-w-xs">
                        <span class="text-[#C5CEE0] block truncate">{{ $g->designation }}</span>
                    </td>
                    <td class="py-4 px-5 text-[#8E9BB0] text-[11px]">
                        {{ $g->affiliation ?? 'Independent' }}
                    </td>
                    <td class="py-4 px-5 font-mono">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] bg-[#1C263A] text-[#2DD4BF] border border-[#2DD4BF]/30">
                            {{ $g->episodes_count ?? $g->episodes()->count() }} Ep(s)
                        </span>
                    </td>
                    <td class="py-4 px-5 text-right font-mono space-x-3 whitespace-nowrap">
                        <a href="{{ route('guests.show', $g->slug) }}" target="_blank" class="text-xs text-[#2DD4BF] hover:underline">
                            Profile
                        </a>

                        <a href="{{ route('admin.guests.edit', $g->id) }}" class="text-xs text-[#C5CEE0] hover:text-[#2DD4BF]">
                            Edit
                        </a>

                        <form action="{{ route('admin.guests.destroy', $g->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this guest record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-400/80 hover:text-red-400 cursor-pointer">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-zinc-500 font-mono">
                        No guests registered. Click "+ Add Thinker / Guest" to add voices to the constellation.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
