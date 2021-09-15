<?php

namespace App\Facades;

use App\Facades\SocialPoster\SocialPoster;
use App\Models\Artwork;
use App\Models\Provider;

class MassPoster
{
    public function post(Artwork $artwork, Provider $providers): array
    {
        $responses = [];
        foreach ($providers as $provider) {
            $sp = new SocialPoster($artwork, $provider);
            $responses[] = $sp->post();
        }
        return $responses;
    }
}
