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

        // Find if provider already exists.
        $p = Auth::user()->providers->where('type', $type)->where('username', $username)->first();
        if ($p) {
            $p->token = $access_token["oauth_token"];
            $p->token_secret = $access_token["oauth_token_secret"];
            $p->save();
            return;
        }

        // If not create a new provider.
        $p = new Provider();
        $p->userID = Auth::user()->id;
        $p->type = "twitter";
        $p->token = $access_token["oauth_token"];
        $p->token_secret = $access_token["oauth_token_secret"];
        $p->username= $access_token["screen_name"];
        $p->save();

        // Get the artworks related to this provider.
        $provider_artworks = Provider::getProviderArtworks($p);

        // If artwork with ID exists attach provider;
        foreach ($provider_artworks as $provider_artwork) {
            $provider_artwork->providers()->attach($p->id);
        }
    }

    private static function getProviderArtworks(Provider $p) {
        // Reconnect all previous artworks posted by this new provider.
        $movements = ArtworkMovement::where('provider_name', $p->type)
            ->where('username', $p->username)->get();
        $artworks = [];
        if (!$movements->isEmpty()) {
            $last_id = $movements->first()->artworkID;
            $last_movement = $movements->first();
            foreach ($movements as $movement)
            {
                if ($last_id != $movement->artworkID)
                {
                    $last_id = $movement->artworkID;
                    // Only add if artwork is still in platform.
                    $artwork = Artwork::find($last_movement->artworkID);
                    if ($artwork && $last_movement->type == 'UPLOAD')
                    {
                        array_push($artworks, $artwork);
                    }
                }
                $last_movement = $movement;
            }
            $artwork = Artwork::find($last_movement->artworkID);
            if ($artwork && $last_movement->type == 'UPLOAD')
            {
                array_push($artworks, $artwork);
            }
        }
        return $artworks;
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
        $movement = new ArtworkMovement;
        $movement->type = "UPLOAD";
        $movement->provider_name = $this->type;
        $movement->username = $this->username;
        $movement->artworkID = $artwork->id;
        $movement->save();
        switch ($this->type) {
            case "twitter":
                return $this->postTwitter($artwork);
        }
        return null;
    }

    public function deletePost(Artwork $artwork)
    {
        $movement = new ArtworkMovement;
        $movement->type = "DELETE";
        $movement->provider_name = $this->type;
        $movement->username = $this->username;
        $movement->artworkID = $artwork->id;
        $movement->save();
        switch ($this->type) {
            case "twitter":
                return $this->deleteTwitter($artwork);
        }
        return null;
    }

    public function deleteScheduled(ScheduledWork $scheduled)
    {
        $scheduled->providers()->detach($this->id);
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

    public function artworks()
    {
        return $this->belongsToMany(Artwork::class);
    }

    public function scheduled_works()
    {
        return $this->belongsToMany(ScheduledWork::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, "userID");
    }

}
