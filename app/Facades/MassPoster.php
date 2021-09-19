<?php

namespace App\Facades;

use App\Facades\SocialPoster\SocialPoster;
use App\Models\Artwork;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MassPoster
{
    public function post(Artwork $artwork, Collection $providers): array
    {
        Log::info("Begin MassPoster");
        $responses = [];
        foreach ($providers as $provider) {
            Log::info($provider);
            $sp = new SocialPoster($artwork, $provider);
            $responses[] = $sp->post();
        }
        Log::info("end MassPoster");
        return $responses;
    }

    public function delete(Artwork $artwork, Collection $providers): array
    {
        Log::info("Begin MassPoster");
        $responses = [];
        foreach ($providers as $provider) {
            Log::info($provider);
            $sp = new SocialPoster($artwork, $provider);
            $responses[] = $sp->delete();
        }
        Log::info("end MassPoster");
        return $responses;
    }
}
