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
        $artwork->published_to = json_encode(['provider' => 'twitter']);
        $artwork->save();

        return $response;
    }

    public function getStatistics(Artwork $artwork)
    {
        //"created_at": "Tue Mar 21 20:50:14 +0000 2006",
        //"id": 20,
        //"id_str": "20",
        //"text": "just setting up my twttr",
//        Definitely needs refactoring. this should be on the model.
        $results = $this->connection->get("statuses/lookup", ["id" => $artwork->twitter_post_id], true);
        return $results;

    }

    public function refreshToken()
    {
        // Twitter needs no token refresh
        return true;
    }

    public function deletePost(Artwork $artwork)
    {
        $result = $this->connection->post("statuses/destroy" . $artwork->twitter_post_id, [], true);
        $artwork->twitter_media_id = null;
        $artwork->twitter_post_id = null;
        $artwork->published_to = null;
        return $result;

    }
}
