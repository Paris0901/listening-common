@extends('layouts.admin')

@section('title', 'Edit Thinker — ' . $guest->name)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.guests.index') }}" class="text-xs font-mono font-medium text-[#8E9BB0] hover:text-[#2DD4BF] mb-2 inline-flex items-center gap-1">
            <span>&larr; Back to Thinkers &amp; Guest Pipeline</span>
        </a>
        <h1 class="font-display text-2xl sm:text-3xl font-medium text-[#F4F4F0]">Edit Thinker Profile</h1>
        <p class="text-xs text-[#8E9BB0] mt-1 font-mono">
            Profile Slug: <span class="text-[#2DD4BF]">/guests/{{ $guest->slug }}</span>
        </p>
    </div>

    <form action="{{ route('admin.guests.update', $guest->id) }}" method="POST" class="space-y-6 bg-[#0C1220] border border-[#1C263A] p-6 sm:p-10 rounded-xl shadow-2xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Full Name &amp; Honorific</label>
                <input type="text" name="name" required value="{{ old('name', $guest->name) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Official Designation / Title</label>
                <input type="text" name="designation" required value="{{ old('designation', $guest->designation) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Institutional Affiliation (Optional)</label>
                <input type="text" name="affiliation" value="{{ old('affiliation', $guest->affiliation) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Portrait Photograph URL</label>
                <input type="url" name="photo_url" value="{{ old('photo_url', $guest->photo_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
        </div>

        <div>
            <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Verified Biographical Overview</label>
            <textarea name="bio" rows="5" required class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">{{ old('bio', $guest->bio) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">Personal Website URL</label>
                <input type="url" name="website_url" value="{{ old('website_url', $guest->website_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">LinkedIn Profile URL</label>
                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $guest->linkedin_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
            <div>
                <label class="block text-xs font-mono font-medium uppercase tracking-wider text-[#C5CEE0] mb-1.5">X / Twitter URL</label>
                <input type="url" name="twitter_url" value="{{ old('twitter_url', $guest->twitter_url) }}" class="w-full px-3.5 py-2.5 rounded-lg bg-[#06080D] border border-[#1C263A] text-xs text-[#F4F4F0] focus:outline-none focus:border-[#2DD4BF]">
            </div>
        </div>

        <div class="pt-4 border-t border-[#1C263A] flex items-center justify-end gap-3">
            <a href="{{ route('admin.guests.index') }}" class="px-4 py-2.5 rounded-lg text-xs font-mono text-[#8E9BB0] hover:text-[#F4F4F0] border border-[#1C263A]">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg font-mono font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-[#5EEAD4] via-[#2DD4BF] to-[#0D9488] text-[#080B11] hover:brightness-110 transition-all shadow-md shadow-[#2DD4BF]/20 cursor-pointer">
                Update Profile &rarr;
            </button>
        </div>
    </form>
</div>
@endsection
