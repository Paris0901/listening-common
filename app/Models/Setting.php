<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Get a setting by key with fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            try {
                if (! Schema::hasTable('settings')) {
                    return $default;
                }

                $setting = static::where('key', $key)->first();

                return $setting ? $setting->value : $default;
            } catch (\Throwable) {
                return $default;
            }
        });
    }

    /**
     * Set a setting by key.
     */
    public static function set(string $key, mixed $value, ?string $description = null): static
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'description' => $description]
        );

        Cache::forget("setting.{$key}");

        return $setting;
    }
}
