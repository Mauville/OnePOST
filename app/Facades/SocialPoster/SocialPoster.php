<?php

namespace App\Facades\SocialPoster;

use App\Facades\SocialPoster\SocialBackends\SocialBackend;
use App\Facades\SocialPoster\SocialBackends\TwitterBackend;
use App\Models\Artwork;
use App\Models\Provider;
use Illuminate\Support\Facades\Log;

class SocialPoster
{
    /**
     * @var Provider
     */
    private $provider;
    private $artwork;

    public function __construct(Artwork $artwork, Provider $provider)
    {
        $this->provider = $provider;
        $this->artwork = $artwork;
    }

    public function post()
    {
//        TODO Refactor to correct response type
        switch ($this->provider->type) {
            case "twitter":
                Log::info("Enter twitter");
                $sb = new TwitterBackend($this->provider->token, $this->provider->token_secret);

                $response = $sb->post($this->artwork);
        }
        return $response;
    }

}
