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
        $artwork->published_to = json_encode(['provider' => ['pending']]);
        $artwork->save();
        return $artwork;
    }
}
