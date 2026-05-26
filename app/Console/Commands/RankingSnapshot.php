<?php

namespace App\Console\Commands;

use App\Models\InstagramProfile;
use App\Models\RankingHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
    protected $description = 'Save current ranking positions to history and calculate rank changes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting ranking snapshot...');

        $profiles = InstagramProfile::where('is_active', true)->get();

        DB::transaction(function () use ($profiles) {
            foreach ($profiles as $profile) {
                // Get the latest history record for this profile
                $lastHistory = RankingHistory::where('profile_id', $profile->id)
                    ->orderBy('recorded_at', 'desc')
                    ->first();

                $rankChange = 0;
                if ($lastHistory) {
                    // Positive change means the rank value decreased (higher position)
                    // e.g., from 10 to 7: 10 - 7 = +3 (up 3 positions)
                    $rankChange = $lastHistory->rank - $profile->rank;
                }

                // Update profile with the new rank change
                $profile->update([
                    'rank_change' => $rankChange,
                ]);

                // Create new history record
                RankingHistory::create([
                    'profile_id' => $profile->id,
                    'rank' => $profile->rank,
                    'followers_count' => $profile->followers_count,
                    'recorded_at' => now(),
                ]);
            }
        });

        $this->info('Ranking snapshot completed successfully. Processed ' . $profiles->count() . ' profiles.');
    }
}
