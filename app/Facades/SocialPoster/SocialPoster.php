<?php

namespace App\Facades\SocialPoster;

use App\Facades\SocialPoster\SocialBackends\SocialBackend;
use App\Facades\SocialPoster\SocialBackends\TwitterBackend;
use App\Models\Artwork;
use App\Models\Provider;

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
        $response = "404";
        switch ($this->provider->type) {
            case "Twitter":
                $sb = new TwitterBackend($this->provider->token);

                $response = $sb->post($this->artwork);
        }
        return $response;
    }

}
