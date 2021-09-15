<?php

namespace App\Facades\SocialPoster\SocialBackends;

use App\Models\Artwork;

class TwitterBackend implements SocialBackend
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function post(Artwork $artwork): string
    {
        // TODO: Implement post() method.
    }

    public function getStatistics(Artwork $artwork)
    {
        // TODO: Implement getStatistics() method.
    }

    public function refreshToken()
    {
        // TODO: Implement refreshToken() method.
    }
}
