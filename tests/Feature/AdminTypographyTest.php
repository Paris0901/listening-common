<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTypographyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guest_cannot_access_typography_page(): void
    {
        $response = $this->get(route('admin.settings.typography'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_typography_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.settings.typography'));
        $response->assertStatus(200);
        $response->assertSee('Typography &amp; Font Selection', false);
        $response->assertSee('Editorial Sanctuary');
    }

    public function test_authenticated_user_can_update_font_preset(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.settings.typography.update'), [
            'preset' => 'literary',
        ]);

        $response->assertRedirect(route('admin.settings.typography'));
        $this->assertEquals('literary', Setting::get('site_font_preset'));
    }
}
