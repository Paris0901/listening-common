<?php

namespace App\Console\Commands;

use App\Services\SubstackNewsletterSyncService;
use Illuminate\Console\Command;

class SyncSubstackNewslettersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:sync-substack {--url= : Optional custom Substack RSS feed URL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize written reflections and newsletters from Substack RSS feed';

    /**
     * Execute the console command.
     */
    public function handle(SubstackNewsletterSyncService $syncService): int
    {
        $customUrl = $this->option('url');

        if ($customUrl) {
            $this->info("Fetching Substack newsletters from: {$customUrl}");
            $result = $syncService->syncFeed($customUrl);
        } else {
            $feedUrls = config('newsletter.substack_feed_urls', ['https://dranindasidhana.substack.com/feed']);
            $this->info('Fetching Substack newsletters from configured feeds: '.implode(', ', $feedUrls));
            $result = $syncService->syncAll();
        }

        if (! $result['success']) {
            $this->error($result['message']);

            return self::FAILURE;
        }

        $this->info($result['message']);
        $this->table(
            ['Feed Source', 'Total Processed', 'New Imported', 'Updated'],
            [
                [$customUrl ?: 'Substack Publications', $result['total'], $result['created'], $result['updated']],
            ]
        );

        return self::SUCCESS;
    }
}
