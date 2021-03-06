<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Artwork extends Model
{
    use HasFactory;

    public $stats = [];

    /**
     *
     * @return Artwork
     * @var mixed
     */
    public static function fromRequest($request, $uri): Artwork
    {
        $artwork = new Artwork();
        $artwork->name = $request->name;
        $artwork->description = $request->description;
        $artwork->URI = $uri;
        $artwork->userID = Auth::user()->id;
        $artwork->save();
        return $artwork;
    }

    public static function fromScheduled($scheduled): Artwork
    {
        $artwork = new Artwork();
        $artwork->name = $scheduled->name;
        $artwork->description = $scheduled->description;
        $artwork->URI = $scheduled->URI;
        $artwork->userID = $scheduled->userID;
        $artwork->save();
        return $artwork;
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }

    /**
     * @return array
     * Get statistics for all the providers that posted this.
     * Will return an associative array of the shape:
     * ["provider" =>["statname" => "stat"
     *                "statname" => "stat" ]
     * ]
     */
    public function getStatistics()
    {
        $stats = [];
        foreach ($this->providers as $provider) {
            $key = $provider->type . '@' . $provider->username;
            $stats[$key] = $provider->getPostStatistics($this);
        }
        return $stats;
    }

    public function user() {
        return $this->belongsTo(User::class, "userID");
    }

    public function movements()
    {
        return $this->hasMany(ArtworkMovement::class,
            'artworkID');
    }
}
