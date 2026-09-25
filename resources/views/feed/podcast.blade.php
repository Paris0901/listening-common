<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" 
    xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" 
    xmlns:content="http://purl.org/rss/1.0/modules/content/" 
    xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>The Listening Commons</title>
    <link>{{ url('/') }}</link>
    <atom:link href="{{ route('feed.podcast') }}" rel="self" type="application/rss+xml"/>
    <language>en-us</language>
    <copyright>&#xA9; {{ date('Y') }} The Listening Commons. All rights reserved.</copyright>
    <itunes:subtitle>Where conversations become common ground.</itunes:subtitle>
    <itunes:author>Marcus Chen &amp; The Listening Commons Team</itunes:author>
    <itunes:summary>An unhurried sanctuary for longform inquiry into Mental Health, Human Dignity, Peace, Gender, Culture, AI, and Lived Experience.</itunes:summary>
    <description>Where conversations become common ground. Hosted by Marcus Chen, exploring deep questions with philosophers, clinicians, peacemakers, and storytellers.</description>
    <itunes:owner>
      <itunes:name>The Listening Commons</itunes:name>
      <itunes:email>broadcast@listeningcommons.com</itunes:email>
    </itunes:owner>
    <itunes:image href="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&amp;fit=crop&amp;w=1400&amp;q=80"/>
    <itunes:category text="Society &amp; Culture">
      <itunes:category text="Philosophy"/>
    </itunes:category>
    <itunes:category text="Health &amp; Fitness">
      <itunes:category text="Mental Health"/>
    </itunes:category>
    <itunes:explicit>false</itunes:explicit>

    @foreach($episodes as $episode)
    <item>
      <title>{{ htmlspecialchars($episode->title) }}</title>
      <itunes:title>{{ htmlspecialchars($episode->title) }}</itunes:title>
      <itunes:episode>{{ $episode->episode_number }}</itunes:episode>
      <itunes:episodeType>full</itunes:episodeType>
      <itunes:author>{{ htmlspecialchars($episode->guest->name ?? 'The Listening Commons') }}</itunes:author>
      <itunes:duration>{{ $episode->audio_duration_seconds ?? 3600 }}</itunes:duration>
      <link>{{ url('/episodes/' . $episode->slug) }}</link>
      <guid isPermaLink="true">{{ url('/episodes/' . $episode->slug) }}</guid>
      <pubDate>{{ $episode->published_at ? $episode->published_at->toRssString() : now()->toRssString() }}</pubDate>
      <description>{{ htmlspecialchars($episode->short_description) }}</description>
      <content:encoded><![CDATA[
        <p>{{ $episode->short_description }}</p>
        <p><strong>Guest:</strong> {{ $episode->guest->name ?? 'Featured Guest' }} ({{ $episode->guest->designation ?? '' }})</p>
        {!! $episode->full_show_notes !!}
        <p><a href="{{ url('/episodes/' . $episode->slug) }}">Read the full verbatim transcript and explore show notes at The Listening Commons</a>.</p>
      ]]></content:encoded>
      <enclosure url="{{ $episode->audio_url }}" length="{{ $episode->audio_bytes ?: 50000000 }}" type="audio/mpeg"/>
      <itunes:image href="{{ $episode->artwork_url ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1400&q=80' }}"/>
      <itunes:explicit>false</itunes:explicit>
    </item>
    @endforeach
  </channel>
</rss>
