<?php

namespace App\Models;

use App\SocialBackends\TwitterBackend\TwitterBackend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Provider extends Model
{
    use HasFactory;

    public static function addProvider($access_token, $type) {
        $username = $access_token["screen_name"];
        $p = Provider::where('type', $type)->where('username', $username)->first();
        if ($p->exists()) {
            $p->token = $access_token["oauth_token"];
            $p->token_secret = $access_token["oauth_token_secret"];
            $p->save();
            return;
        }
        $p = new Provider();
        $p->userID = Auth::user()->id;
        $p->type = "twitter";
        $p->token = $access_token["oauth_token"];
        $p->token_secret = $access_token["oauth_token_secret"];
        $p->username= $access_token["screen_name"];
        $p->save();
    }

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
