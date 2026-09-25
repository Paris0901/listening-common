<?php

namespace Tests\Feature;

use App\Models\Episode;
use App\Models\User;
use App\Services\SpotifyPodcastSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SpotifyPodcastSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function getSampleSpotifyRssXml(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>The Listening Commons</title>
    <description>Conversations on Psychiatry, Culture, and Human Dignity</description>
    <link>https://anchor.fm/listeningcommons</link>
    <itunes:image href="https://images.unsplash.com/photo-1518495973542-4542c06a5843?auto=format&amp;fit=crop&amp;w=1000&amp;q=80"/>
    <item>
      <title>When Systems Learn to Listen</title>
      <guid isPermaLink="false">spotify-guid-ep-01-systems</guid>
      <pubDate>Mon, 22 Sep 2026 12:00:00 GMT</pubDate>
      <description><![CDATA[A psychiatrist who became a survivor asks what happens when lived experience changes the person on the clinical side.]]></description>
      <content:encoded><![CDATA[<p>Full show notes and narrative transcript regarding relational care and institutional empathy.</p>]]></content:encoded>
      <enclosure url="https://anchor.fm/s/test/audio/ep01.mp3" length="45210000" type="audio/mpeg"/>
      <itunes:duration>54:12</itunes:duration>
      <itunes:episode>1</itunes:episode>
      <itunes:season>1</itunes:season>
      <itunes:author>Scott Douglas Jacobsen &amp; Dr. Aninda Sidhana</itunes:author>
      <itunes:image href="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&amp;fit=crop&amp;w=800&amp;q=80"/>
    </item>
    <item>
      <title>The Architecture of Human Dignity</title>
      <guid isPermaLink="false">spotify-guid-ep-02-dignity</guid>
      <pubDate>Wed, 24 Sep 2026 14:30:00 GMT</pubDate>
      <description><![CDATA[An inquiry into peacebuilding, dignity, and why no one heals alone.]]></description>
      <content:encoded><![CDATA[<p>Exploring survivor-informed psychiatry and community restorative systems.</p>]]></content:encoded>
      <enclosure url="https://anchor.fm/s/test/audio/ep02.mp3" length="38900000" type="audio/mpeg"/>
      <itunes:duration>48:30</itunes:duration>
      <itunes:episode>2</itunes:episode>
      <itunes:season>1</itunes:season>
      <itunes:author>Scott Douglas Jacobsen</itunes:author>
    </item>
  </channel>
</rss>
XML;
    }

    public function test_spotify_sync_service_parses_rss_xml_accurately_into_episodes(): void
    {
        $syncService = app(SpotifyPodcastSyncService::class);
        $result = $syncService->parseAndSyncXml($this->getSampleSpotifyRssXml(), 'https://anchor.fm/s/listeningcommons/podcast/rss');

        $this->assertTrue($result['success']);
        $this->assertEquals(2, $result['total']);
        $this->assertGreaterThanOrEqual(1, $result['created'] + $result['updated']);

        // Verify Episode 1 is in database with Spotify metadata
        $ep1 = Episode::where('spotify_guid', 'spotify-guid-ep-01-systems')->first();
        $this->assertNotNull($ep1);
        $this->assertEquals('When Systems Learn to Listen', $ep1->title);
        $this->assertEquals('https://anchor.fm/s/test/audio/ep01.mp3', $ep1->audio_url);
        $this->assertEquals((54 * 60) + 12, $ep1->audio_duration_seconds);
        $this->assertTrue($ep1->is_published);
        $this->assertNotNull($ep1->spotify_synced_at);

        // Verify Episode 2 is in database
        $ep2 = Episode::where('spotify_guid', 'spotify-guid-ep-02-dignity')->first();
        $this->assertNotNull($ep2);
        $this->assertEquals('The Architecture of Human Dignity', $ep2->title);
        $this->assertEquals('https://anchor.fm/s/test/audio/ep02.mp3', $ep2->audio_url);
        $this->assertEquals((48 * 60) + 30, $ep2->audio_duration_seconds);
    }

    public function test_artisan_command_syncs_spotify_podcast_successfully(): void
    {
        Http::fake([
            '*' => Http::response($this->getSampleSpotifyRssXml(), 200),
        ]);

        $this->artisan('podcast:sync-spotify')
            ->expectsOutputToContain('Successfully synced 2 episodes from Spotify RSS feed!')
            ->assertExitCode(0);
    }

    public function test_admin_can_trigger_spotify_sync_from_dashboard(): void
    {
        Http::fake([
            '*' => Http::response($this->getSampleSpotifyRssXml(), 200),
        ]);

        $admin = User::first();

        $response = $this->actingAs($admin)->post('/admin/episodes/sync-spotify', [
            'spotify_rss_url' => 'https://anchor.fm/s/custom/podcast/rss',
        ]);

        $response->assertRedirect('/admin/episodes');
        $response->assertSessionHas('success');
    }
}
