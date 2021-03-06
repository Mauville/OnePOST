<?php

namespace App\SocialBackends\TwitterBackend;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Artwork;
use App\SocialBackends\SocialBackend;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TwitterBackend implements SocialBackend
{
    private $token;
    private $connection;
    private $secret_token;

    public function __construct($token, $secrettoken)
    {
        $this->token = $token;
        $this->secret_token = $secrettoken;
        $this->connection = $connection = new TwitterOAuth(config("twitter.consumer_key"), config("twitter.consumer_secret"), $this->token, $this->secret_token);
        $this->connection->setTimeouts(10, 15);
    }


    public function createPost(Artwork $artwork)
    {
        $path = Storage::url($artwork->URI);
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        $contents = file_get_contents($path);
        // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($contents);
        Storage::disk('local')->put($artwork->URI, $contents);
        $pathFile = storage_path("app/" . $artwork->URI);
        $media = $this->connection->upload('media/upload', ['media' => $pathFile]);
        $parameters = [
            'status' => $artwork->description,
            'media_ids' => $media->media_id_string
        ];
        $response = $this->connection->post('statuses/update', $parameters);

        // Save response
        $artwork->twitter_media_id = $media->media_id_string;
        $artwork->twitter_post_id = $response->id_str;
        $artwork->save();
        return $response;
    }

    public function uploadImageFromS3($connection, $path, $parameters) {
        $file = file_get_contents($path);
        $parameters['media'] = base64_encode($file);
        return $this->http(
            'POST',
            $connection::UPLOAD_HOST,
            $path,
            $parameters,
            false,
        );
    }

    /**
     * @param Artwork $artwork
     * @return string[]
     * Returns the retweet count and favorite_count of a tweet in an assoc array.
     */
    public function getStatistics(Artwork $artwork)
    {
        $results = $this->connection->get("statuses/lookup", ["id" => $artwork->twitter_post_id], true);
        if ($this->connection->getLastHttpCode() == 200 and !(empty($results))) {
            $stat = [];
            $stat["retweet_count"] = $results[0]->retweet_count;
            $stat["favorite_count"] = $results[0]->favorite_count;
            return $stat;
        }
        return null;
    }

    public function refreshToken()
    {
        // Twitter needs no token refresh
        return true;
    }

    public function deletePost(Artwork $artwork)
    {
        $result = $this->connection->post("statuses/destroy/" . $artwork->twitter_post_id, [], true);
        if ($this->connection->getLastHttpCode() == 200) {
            $artwork->twitter_media_id = null;
            $artwork->twitter_post_id = null;
            $artwork->published_to = null;
            return true;
        }
        return false;

    }
}
