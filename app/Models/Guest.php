<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'designation',
        'affiliation',
        'bio',
        'photo_url',
        'website_url',
        'linkedin_url',
        'twitter_url',
    ];

    /**
     * Episodes featuring this guest.
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }
}
