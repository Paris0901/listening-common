@extends('layouts.admin')

@section('title', 'Reflections & Essays CMS')

@section('content')
<div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
        <span class="text-[10px] font-mono uppercase tracking-widest text-[#2DD4BF] block mb-1">EDITORIAL REPOSITORY</span>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Reflections &amp; Essays</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 max-w-2xl">
            Journal-style archive of written reflections from Scott Douglas Jacobsen, Dr. Aninda Sidhana, and invited clinical/philosophical contributors.
        </p>
    </div>

    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] text-xs font-mono font-bold uppercase tracking-wider hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 shrink-0 cursor-pointer">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Write New Essay</span>
    </a>
</div>

<div class="bg-[#0C1220] border border-[#1C263A] rounded-xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-[#F4F4F0]">
            <thead class="bg-[#06080D] border-b border-[#1C263A] text-[11px] font-mono font-medium uppercase tracking-wider text-[#8E9BB0]">
                <tr>
                    <th class="py-3.5 px-5">Title &amp; Route</th>
                    <th class="py-3.5 px-5">Author</th>
                    <th class="py-3.5 px-5">Thematic Collection</th>
                    <th class="py-3.5 px-5">Published Date</th>
                    <th class="py-3.5 px-5">Status</th>
                    <th class="py-3.5 px-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1C263A]/70">
                @forelse($articles as $art)
                <tr class="hover:bg-[#121A2B]/50 transition-colors">
                    <td class="py-4 px-5 max-w-sm">
                        <span class="font-display font-medium text-sm block truncate text-[#F4F4F0]">{{ $art->title }}</span>
                        <span class="text-[11px] text-[#8E9BB0] font-mono">/articles/{{ $art->slug }}</span>
                    </td>
                    <td class="py-4 px-5">
                        <span class="font-medium text-[#F4F4F0] block">{{ $art->author_name }}</span>
                    </td>
                    <td class="py-4 px-5 text-[#8E9BB0] font-mono text-[11px]">
                        {{ $art->theme->name ?? 'General Reflection' }}
                    </td>
                    <td class="py-4 px-5 font-mono text-[#8E9BB0]">
                        {{ $art->published_at ? $art->published_at->format('M d, Y') : '—' }}
                    </td>
                    <td class="py-4 px-5">
                        @if($art->is_published)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium uppercase tracking-wider bg-emerald-950/70 text-emerald-300 border border-emerald-800/50">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Published
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium uppercase tracking-wider bg-amber-950/70 text-amber-300 border border-amber-800/50">
                            Draft
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-5 text-right font-mono space-x-3 whitespace-nowrap">
                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="text-xs text-[#C5CEE0] hover:text-[#2DD4BF]">
                            Edit
                        </a>

                        <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this essay?');">
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
                    <td colspan="6" class="py-12 text-center text-zinc-500 font-mono">
                        No essays in the repository yet. Click "+ Write New Essay" to publish one.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
