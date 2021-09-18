<?php

namespace App\Facades\SocialPoster\SocialBackends;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Artwork;
use Illuminate\Support\Facades\Log;

class TwitterBackend implements SocialBackend
{
    private $token;
    private $connection;

    public function __construct($token, $secrettoken)
    {
        $this->token = $token;
        $this->secret_token = $secrettoken;
        $this->connection = $connection = new TwitterOAuth(config("twitter.consumer_key"), config("twitter.consumer_secret"), $this->token, $this->secret_token);
        $this->connection->setTimeouts(10, 15);
    }

    public function post(Artwork $artwork)
    {
        Log::info("Begin twitterPOST");
        $media = $this->connection->upload('media/upload', ['media' => storage_path("app/" . $artwork->URI)]);
        $parameters = [
            'status' => $artwork->description,
//            'media_ids' => implode(',', [$media->media_id_string])
            'media_ids' => $media->media_id_string
        ];
        $response = $this->connection->post('statuses/update', $parameters);

        // Save response
        $artwork->twitter_media_id = $media->media_id_string;
        $artwork->twitter_post_id = $response->id_string;
        $artwork->save();

        return $response;
    }

    public function getStatistics(Artwork $artwork)
    {
        // TODO: Implement getStatistics() method.
    }

    public function refreshToken()
    {
        // TODO: Implement refreshToken() method.
    }

    public function deletePost(Artwork $artwork)
    {
        $result = $this->connection->post("statuses/destroy" . $artwork->twitter_post_id, [], true);
        $artwork->twitter_media_id = null;
        $artwork->twitter_post_id = null;
        return $result;

    }
}
