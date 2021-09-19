<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Artwork extends Model
{
    use HasFactory;

    /**
     *
     * @return Artwork
     * @var mixed
     */
    public static function fromRequest(Request $request): Artwork
    {
        $path = $request->file('art')->store('art');
        $artwork = new Artwork();
        $artwork->name = $request->name;
        $artwork->description = $request->description;
        $artwork->URI = $path;
        $artwork->userID = Auth::user()->id;
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
            $stats[$provider->type] = $provider->getPostStatistics($this);
        }
        return $stats;

    }
}
