<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <!-- Core Editorial Hub Pages -->
  <url>
    <loc>{{ url('/') }}</loc>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ route('episodes.index') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ route('articles.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('newsletter') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('themes.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('guests.index') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ route('watch') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ route('listen') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ route('about') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ route('collaborations') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <url>
    <loc>{{ route('press') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <url>
    <loc>{{ route('contact') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <url>
    <loc>{{ route('editorial.policy') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>{{ route('medical.disclaimer') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>
  <url>
    <loc>{{ route('privacy') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

  <!-- Canonical Episode Archives -->
  @foreach($episodes as $episode)
  <url>
    <loc>{{ url('/episodes/' . $episode->slug) }}</loc>
    <lastmod>{{ $episode->published_at ? $episode->published_at->toIso8601String() : now()->toIso8601String() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  @endforeach

  <!-- Substack Articles & Written Dispatches -->
  @foreach($articles as $article)
  <url>
    <loc>{{ $article->substack_url ?? url('/articles/' . $article->slug) }}</loc>
    <lastmod>{{ $article->published_at ? $article->published_at->toIso8601String() : now()->toIso8601String() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  @endforeach

  <!-- Guest Thought-Leader Profiles -->
  @foreach($guests as $guest)
  <url>
    <loc>{{ url('/guests/' . $guest->slug) }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach

  <!-- Thematic Collections -->
  @foreach($themes as $theme)
  <url>
    <loc>{{ url('/themes/' . $theme->slug) }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach
</urlset>
