<?php

namespace App\Facades\SocialPoster\SocialBackends;

use App\Models\Artwork;

interface SocialBackend
{
    public function post(Artwork $artwork);

    public function getStatistics(Artwork $artwork);

    public function refreshToken();
}
