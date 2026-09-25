<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Substack RSS Feed Sources
    |--------------------------------------------------------------------------
    |
    | Substack feeds from which newsletters and written reflections are ingested.
    | Dr. Aninda Sidhana's personal publication ("The Dignity Dialogues") is active,
    | and The Listening Commons publication can be added as well.
    |
    */
    'substack_feed_urls' => array_filter(explode(',', env('SUBSTACK_FEED_URLS', 'https://dranindasidhana.substack.com/feed'))),

    /*
    |--------------------------------------------------------------------------
    | Auto Sync Configuration
    |--------------------------------------------------------------------------
    */
    'auto_sync' => env('SUBSTACK_AUTO_SYNC', true),
];
