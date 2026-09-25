<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'episode_id',
        'theme_id',
        'summary',
        'body',
        'cover_url',
        'substack_guid',
        'substack_url',
        'substack_synced_at',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'substack_synced_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function getReadingTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->body ?? $this->summary ?? ''));
        $minutes = max(1, (int) ceil($wordCount / 200));

        return "{$minutes} min read";
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}
