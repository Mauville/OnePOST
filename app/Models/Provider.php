<?php

namespace App\Models;

use App\SocialBackends\TwitterBackend\TwitterBackend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    public $token;
    /**
     * @var mixed
     */
    public $token_secret;
    /**
     * @var mixed
     */
    public $type;
    /**
     * @var mixed
     */
    public $provider;

    private function postTwitter(Artwork $artwork)
    {
        $backend = new TwitterBackend($this->token, $this->token_secret);
        return $backend->createPost($artwork);
    }

    private function deleteTwitter(Artwork $artwork)
    {
        $backend = new TwitterBackend($this->token, $this->token_secret);
        return $backend->deletePost($artwork);
    }

    public function createPost(Artwork $artwork)
    {
        switch ($this->type) {
            case "twitter":
                return $this->postTwitter($artwork);
        }
        return null;
    }

    public function deletePost(Artwork $artwork)
    {
        switch ($this->provider->type) {
            case "twitter":
                return $this->deleteTwitter($artwork);
        }
        return null;
    }

}
