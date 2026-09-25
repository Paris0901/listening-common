<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use Illuminate\Support\Facades\Schedule;

Schedule::command('podcast:sync-spotify')->hourly()->when(fn () => config('podcast.auto_sync', true));
Schedule::command('newsletter:sync-substack')->hourly()->when(fn () => config('newsletter.auto_sync', true));
