<?php

namespace App\Jobs;

use App\Models\Artwork;
use App\Models\ScheduledWork;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Repost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scheduleds = ScheduledWork::whereDate('time_scheduled', '<=', Carbon::now())->get();
        foreach ($scheduleds as $scheduled) {
            // Sacer providers
            $providers = $scheduled->providers;

            if (!$providers->isEmpty()) {
                $artwork = Artwork::fromScheduled($scheduled);
                // Mass Post
                foreach ($providers as $provider) {
                    $provider->createPost($artwork);
                }
            }
            $scheduled->delete();
        }
    }
}
