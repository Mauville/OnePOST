<?php

namespace App\Facades;

use App\Facades\SocialPoster\SocialPoster;
use App\Models\Artwork;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class MassPoster
{
    public function post(Artwork $artwork, Provider $providers): array
    {
//        Auth::user()->getProviders();
        $responses = [];
        foreach ($providers as $provider) {
            $sp = new SocialPoster($artwork, $provider);
            $responses[] = $sp->post();
        }
        return $responses;
    }
}
