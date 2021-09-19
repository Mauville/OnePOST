<?php

namespace App\Models;

use App\SocialBackends\TwitterBackend\TwitterBackend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;


    private function postTwitter(Artwork $artwork)
    {
        $backend = new TwitterBackend($this->token, $this->token_secret);
        $artwork->providers()->attach($this->id);
        return $backend->createPost($artwork);
    }

    private function deleteTwitter(Artwork $artwork)
    {
        $backend = new TwitterBackend($this->token, $this->token_secret);
        $artwork->providers()->detach($this->id);
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
        switch ($this->type) {
            case "twitter":
                return $this->deleteTwitter($artwork);
        }
        return null;
    }

    private function twitterStatistics(Artwork $artwork)
    {
        $backend = new TwitterBackend($this->token, $this->token_secret);
        return $backend->getStatistics($artwork);
    }

    public function getPostStatistics(Artwork $artwork)
    {
        switch ($this->type) {
            case "twitter":
                return $this->twitterStatistics($artwork);
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, "userID");
    }

}
