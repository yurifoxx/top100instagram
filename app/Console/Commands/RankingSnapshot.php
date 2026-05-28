<?php

namespace App\Console\Commands;

use App\Models\InstagramProfile;
use App\Models\RankingHistory;
use Illuminate\Console\Command;

class RankingSnapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranking:snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a snapshot of current rankings for all active profiles';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $profiles = InstagramProfile::ranking()->get();

        $this->info("Taking snapshot for {$profiles->count()} profiles...");

        foreach ($profiles as $profile) {
            RankingHistory::create([
                'profile_id' => $profile->id,
                'rank' => $profile->rank,
                'followers_count' => $profile->followers_count,
                'recorded_at' => now(),
            ]);
        }

        $this->info('Snapshot completed successfully.');
    }
}
