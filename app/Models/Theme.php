<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'color_accent',
        'icon_svg',
    ];

    /**
     * Episodes classified under this theme.
     */
    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_theme');
    }

    /**
     * Written reflections under this theme.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
