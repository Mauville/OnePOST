<?php

namespace App\SocialBackends;

use App\Models\Artwork;

interface SocialBackend
{
    public function createPost(Artwork $artwork);

    public function getStatistics(Artwork $artwork);

    public function refreshToken();

    public function deletePost(Artwork $artwork);
}
