<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Services\SubstackNewsletterSyncService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SubstackNewsletterSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function getSampleSubstackRssXml(): string
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>Dr aninda Sidhana</title>
    <link>https://dranindasidhana.substack.com</link>
    <description>Psychiatry, human dignity, and lived experience.</description>
    <item>
      <title>The Listening Commons: Because Being Heard Is Part of Being Human</title>
      <link>https://dranindasidhana.substack.com/p/the-listening-commons-because-being</link>
      <guid isPermaLink="false">https://dranindasidhana.substack.com/p/the-listening-commons-because-being</guid>
      <pubDate>Wed, 19 Aug 2026 08:50:04 GMT</pubDate>
      <dc:creator>Dr aninda Sidhana</dc:creator>
      <description><![CDATA[When public discourse equates human worth with professional output, silence feels like annihilation.]]></description>
      <content:encoded><![CDATA[<p>Full longform reflection on human dignity, attentive presence, and authentic inquiry.</p>]]></content:encoded>
      <enclosure url="https://substackcdn.com/sample-art.png" length="102400" type="image/png"/>
    </item>
    <item>
      <title>From Collective Intelligence to Collective Care</title>
      <link>https://dranindasidhana.substack.com/p/from-collective-intelligence-to-collective</link>
      <guid isPermaLink="false">https://dranindasidhana.substack.com/p/from-collective-intelligence-to-collective</guid>
      <pubDate>Wed, 09 Sep 2026 12:48:42 GMT</pubDate>
      <dc:creator>Dr aninda Sidhana</dc:creator>
      <description><![CDATA[Moving past individualistic resilience toward relational care architectures.]]></description>
      <content:encoded><![CDATA[<p>An essay on healthcare systems and relational dignity.</p>]]></content:encoded>
    </item>
  </channel>
</rss>
XML;
    }

    public function test_sync_service_imports_substack_letters_successfully(): void
    {
        Http::fake([
            'https://dranindasidhana.substack.com/feed*' => Http::response($this->getSampleSubstackRssXml(), 200),
        ]);

        $service = app(SubstackNewsletterSyncService::class);
        $result = $service->syncFeed('https://dranindasidhana.substack.com/feed');

        $this->assertTrue($result['success']);
        $this->assertEquals(2, $result['total']);
        $this->assertGreaterThanOrEqual(1, $result['created']);

        $this->assertDatabaseHas('articles', [
            'title' => 'The Listening Commons: Because Being Heard Is Part of Being Human',
            'substack_guid' => 'https://dranindasidhana.substack.com/p/the-listening-commons-because-being',
            'cover_url' => 'https://substackcdn.com/sample-art.png',
        ]);
    }

    public function test_artisan_sync_command_runs_successfully(): void
    {
        Http::fake([
            '*substack.com/feed*' => Http::response($this->getSampleSubstackRssXml(), 200),
        ]);

        $this->artisan('newsletter:sync-substack')
            ->assertSuccessful();

        $this->assertDatabaseHas('articles', [
            'title' => 'From Collective Intelligence to Collective Care',
        ]);
    }

    public function test_newsletter_page_renders_recent_letters(): void
    {
        Article::create([
            'title' => 'Test Substack Dispatch for The Commons',
            'slug' => 'test-substack-dispatch',
            'author_name' => 'Dr. Aninda Sidhana',
            'summary' => 'A test summary for testing the newsletter page.',
            'body' => '<p>Full content</p>',
            'substack_url' => 'https://dranindasidhana.substack.com/p/test-dispatch',
            'published_at' => now(),
            'is_published' => true,
        ]);

        $response = $this->get(route('newsletter'));
        $response->assertStatus(200);
        $response->assertSee('Test Substack Dispatch for The Commons');
    }
}
