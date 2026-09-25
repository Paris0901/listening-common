<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'episode_number',
        'title',
        'slug',
        'guest_id',
        'host_names',
        'short_description',
        'full_show_notes',
        'key_quotations',
        'relevant_links',
        'transcript',
        'artwork_url',
        'audio_url',
        'audio_duration_seconds',
        'audio_bytes',
        'youtube_url',
        'youtube_id',
        'spotify_url',
        'spotify_guid',
        'spotify_synced_at',
        'apple_podcasts_url',
        'amazon_music_url',
        'is_published',
        'is_featured',
        'published_at',
        'seo_title',
        'meta_description',
        'keywords',
        'canonical_url',
        'plays_count',
        'views_count',
    ];

    protected $casts = [
        'key_quotations' => 'array',
        'relevant_links' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'spotify_synced_at' => 'datetime',
        'episode_number' => 'integer',
        'audio_duration_seconds' => 'integer',
        'audio_bytes' => 'integer',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function themes(): BelongsToMany
    {
        return $this->belongsToMany(Theme::class, 'episode_theme');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Formatted MM:SS or HH:MM:SS duration string.
     */
    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->audio_duration_seconds ?: 0;
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
        }

        return sprintf('%02d:%02d', $minutes, $secs);
    }
}
