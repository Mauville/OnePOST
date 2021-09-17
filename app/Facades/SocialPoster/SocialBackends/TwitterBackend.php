<?php

namespace App\Facades\SocialPoster\SocialBackends;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Artwork;
use Illuminate\Support\Facades\Log;

class TwitterBackend implements SocialBackend
{
    private $token;

    public function __construct($token, $secrettoken)
    {
        $this->token = $token;
        $this->secret_token = $secrettoken;
    }

    public function post(Artwork $artwork)
    {
        Log::info("Begin twitterPOST");
        $connection = new TwitterOAuth(config("twitter.consumer_key"), config("twitter.consumer_secret"), $this->token, $this->secret_token);
        $connection->setTimeouts(10, 15);
        $media = $connection->upload('media/upload', ['media' => storage_path("app/" . $artwork->URI)]);
        $parameters = [
            'status' => $artwork->description,
//            'media_ids' => implode(',', [$media->media_id_string])
            'media_ids' => $media->media_id_string
        ];
        $result = $connection->post('statuses/update', $parameters);
        return $result;
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
