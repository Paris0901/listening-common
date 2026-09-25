<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Guests
        if (! Schema::hasTable('guests')) {
            Schema::create('guests', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('designation');
                $table->string('affiliation')->nullable();
                $table->text('bio');
                $table->string('photo_url', 1024)->nullable();
                $table->string('website_url', 1024)->nullable();
                $table->string('linkedin_url', 1024)->nullable();
                $table->string('twitter_url', 1024)->nullable();
                $table->timestamps();
            });
        }

        // 2. Themes
        if (! Schema::hasTable('themes')) {
            Schema::create('themes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('tagline')->nullable();
                $table->text('description');
                $table->string('color_accent', 50)->default('#C59B27');
                $table->text('icon_svg')->nullable();
                $table->timestamps();
            });
        }

        // 3. Episodes
        if (! Schema::hasTable('episodes')) {
            Schema::create('episodes', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('episode_number');
                $table->string('title');
                $table->string('slug')->unique();
                $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
                $table->string('host_names')->default('Scott Douglas Jacobsen & The Listening Commons Team');

                $table->text('short_description');
                $table->longText('full_show_notes');
                $table->json('key_quotations')->nullable();
                $table->json('relevant_links')->nullable();
                $table->longText('transcript')->nullable();

                $table->string('artwork_url', 1024)->nullable();
                $table->string('audio_url', 1024);
                $table->unsignedInteger('audio_duration_seconds')->default(0);
                $table->unsignedBigInteger('audio_bytes')->default(0);
                $table->string('youtube_url', 1024)->nullable();
                $table->string('youtube_id', 50)->nullable();
                $table->string('spotify_url', 1024)->nullable();
                $table->string('apple_podcasts_url', 1024)->nullable();
                $table->string('amazon_music_url', 1024)->nullable();

                $table->boolean('is_published')->default(true);
                $table->boolean('is_featured')->default(false);
                $table->dateTime('published_at');

                $table->string('seo_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('keywords', 500)->nullable();
                $table->string('canonical_url', 1024)->nullable();

                $table->unsignedBigInteger('plays_count')->default(0);
                $table->unsignedBigInteger('views_count')->default(0);

                $table->timestamps();
            });
        }

        // 4. Episode Theme Pivot
        if (! Schema::hasTable('episode_theme')) {
            Schema::create('episode_theme', function (Blueprint $table) {
                $table->id();
                $table->foreignId('episode_id')->constrained('episodes')->cascadeOnDelete();
                $table->foreignId('theme_id')->constrained('themes')->cascadeOnDelete();
                $table->timestamps();

                $table->unique(['episode_id', 'theme_id']);
            });
        }

        // 5. Distribution Drafts & Approval Queue
        if (! Schema::hasTable('distribution_drafts')) {
            Schema::create('distribution_drafts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('episode_id')->constrained('episodes')->cascadeOnDelete();
                $table->enum('channel', ['linkedin', 'instagram', 'facebook', 'youtube', 'substack']);
                $table->string('title');
                $table->longText('content');
                $table->json('metadata')->nullable();
                $table->enum('status', ['draft', 'approved', 'scheduled', 'published'])->default('draft');
                $table->dateTime('scheduled_at')->nullable();
                $table->dateTime('published_at')->nullable();
                $table->string('approved_by')->nullable();
                $table->timestamps();
            });
        }

        // 6. Articles & Editorial Reflections
        if (! Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('author_name')->default('The Listening Commons Editorial Board');
                $table->foreignId('episode_id')->nullable()->constrained('episodes')->nullOnDelete();
                $table->foreignId('theme_id')->nullable()->constrained('themes')->nullOnDelete();
                $table->text('summary');
                $table->longText('body');
                $table->string('cover_url', 1024)->nullable();
                $table->dateTime('published_at');
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // 7. Analytics Events
        if (! Schema::hasTable('analytics_events')) {
            Schema::create('analytics_events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('episode_id')->nullable()->constrained('episodes')->nullOnDelete();
                $table->string('event_type', 50);
                $table->string('utm_source', 100)->nullable();
                $table->string('utm_medium', 100)->nullable();
                $table->string('utm_campaign', 100)->nullable();
                $table->string('referrer', 1024)->nullable();
                $table->string('ip_hash', 64)->nullable();
                $table->string('country', 50)->nullable();
                $table->string('user_agent', 500)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('distribution_drafts');
        Schema::dropIfExists('episode_theme');
        Schema::dropIfExists('episodes');
        Schema::dropIfExists('themes');
        Schema::dropIfExists('guests');
    }
};
