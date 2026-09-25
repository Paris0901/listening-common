<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListeningCommonsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_loads_successfully_with_editorial_elements(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('THE LISTENING COMMONS');
        $response->assertSee('Where conversations become common ground');
    }

    public function test_episodes_archive_loads_successfully(): void
    {
        $response = $this->get('/episodes');

        $response->assertStatus(200);
        $response->assertSee('Conversations &amp; Broadcasts', false);
    }

    public function test_canonical_episode_page_loads_with_transcript_and_seo(): void
    {
        $response = $this->get('/episodes/patricia-elias-women-peace-security-unscr-1325');

        $response->assertStatus(200);
        $response->assertSee('Patricia Elias');
        $response->assertSee('Women, Peace &amp; Security', false);
        $response->assertSee('Crawlable Knowledge Transcript');
    }

    public function test_guests_directory_loads_successfully(): void
    {
        $response = $this->get('/guests');

        $response->assertStatus(200);
        $response->assertSee('Featured Thinkers');
    }

    public function test_themes_directory_loads_successfully(): void
    {
        $response = $this->get('/themes');

        $response->assertStatus(200);
        $response->assertSee('Thematic Collections');
    }

    public function test_podcast_rss_feed_redirects_to_single_master_spotify_feed(): void
    {
        $response = $this->get('/feed/podcast');

        $response->assertRedirect(config('podcast.spotify_rss_url'));
    }

    public function test_sitemap_xml_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');
        $response->assertSee('<urlset', false);
    }

    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Editorial Publishing CMS');
        $response->assertSee('Enter the Commons CMS');
    }

    public function test_unauthenticated_user_is_redirected_to_login_from_admin(): void
    {
        $response = $this->get('/admin/episodes');

        $response->assertRedirect('/login');
    }

    public function test_user_can_authenticate_with_valid_credentials(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@listeningcommons.com'],
            ['name' => 'Editorial Admin', 'password' => bcrypt('password')]
        );

        $response = $this->post('/login', [
            'email' => 'admin@listeningcommons.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.episodes.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_authenticate_with_invalid_credentials(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@listeningcommons.com',
            'password' => 'wrong-secret-key',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_admin_can_access_all_cms_sections(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@listeningcommons.com'],
            ['name' => 'Editorial Admin', 'password' => bcrypt('password')]
        );

        $this->actingAs($user);

        // 1. Episodes
        $episodes = $this->get('/admin/episodes');
        $episodes->assertStatus(200);
        $episodes->assertSee('Master Conversations Library');

        // 2. Articles & Essays
        $articles = $this->get('/admin/articles');
        $articles->assertStatus(200);
        $articles->assertSee('Reflections &amp; Essays', false);

        // 3. Guests & Thinkers Profiles
        $guests = $this->get('/admin/guests');
        $guests->assertStatus(200);
        $guests->assertSee('Thinkers &amp; Guest Profiles', false);

        // 4. Typography & Font Selection
        $typography = $this->get('/admin/typography');
        $typography->assertStatus(200);
        $typography->assertSee('Typography &amp; Font Selection', false);

        // 5. Inquiries & Letters
        $inbox = $this->get('/admin/inbox');
        $inbox->assertStatus(200);
        $inbox->assertSee('Letters &amp; Editorial Inquiries', false);
    }

    public function test_user_can_logout(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@listeningcommons.com'],
            ['name' => 'Editorial Admin', 'password' => bcrypt('password')]
        );

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
