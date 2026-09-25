@extends('layouts.admin')

@section('title', 'Edit Essay — ' . $article->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-mono font-medium text-[#8E9BB0] hover:text-[#2DD4BF] mb-2 inline-flex items-center gap-1">
            <span>&larr; Back to Reflections &amp; Essays</span>
        </a>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Edit Reflection / Essay</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 font-mono">
            Article Slug: <span class="text-[#2DD4BF]">/articles/{{ $article->slug }}</span>
        </p>
    </div>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" class="space-y-6 bg-[#0C1220] border border-[#1C263A] p-6 sm:p-10 rounded-xl shadow-2xl">
        @csrf
        @method('PUT')

        <!-- Title & Author -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Essay Title</label>
                <input type="text" name="title" required value="{{ old('title', $article->title) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Author Attribution</label>
                <input type="text" name="author_name" required value="{{ old('author_name', $article->author_name) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
        </div>

        <!-- Thematic Association & Companion Episode -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Primary Thematic Collection</label>
                <select name="theme_id" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                    <option value="">None / General Inquiry</option>
                    @foreach($themes as $theme)
                    <option value="{{ $theme->id }}" {{ $article->theme_id == $theme->id ? 'selected' : '' }}>
                        {{ $theme->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Companion Episode (Optional)</label>
                <select name="episode_id" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
                    <option value="">Standalone Essay</option>
                    @foreach($episodes as $ep)
                    <option value="{{ $ep->id }}" {{ $article->episode_id == $ep->id ? 'selected' : '' }}>
                        Ep. #{{ $ep->episode_number }}: {{ $ep->title }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Cover Image URL -->
        <div>
            <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Cover Image URL</label>
            <input type="url" name="cover_url" value="{{ old('cover_url', $article->cover_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
        </div>

        <!-- Summary / Excerpt -->
        <div>
            <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Brief Excerpt / Standfirst</label>
            <textarea name="summary" rows="3" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('summary', $article->summary) }}</textarea>
        </div>

        <!-- Body Content -->
        <div>
            <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Essay Body Content (Markdown / HTML Supported)</label>
            <textarea name="body" rows="12" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs font-mono text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('body', $article->body) }}</textarea>
        </div>

        <!-- Publication Controls -->
        <div class="pt-4 border-t border-[#1C263A] flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer font-mono text-xs text-[#C5CEE0]">
                <input type="checkbox" name="is_published" value="1" {{ $article->is_published ? 'checked' : '' }} class="accent-[#2DD4BF] w-4 h-4">
                <span>Published Publicly</span>
            </label>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2.5 rounded-lg text-xs font-mono text-[#8E9BB0] hover:text-[#F4F4F0] border border-[#1C263A]">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg font-mono font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 cursor-pointer">
                    Update Essay &rarr;
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
