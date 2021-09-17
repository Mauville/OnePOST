<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\MassPoster;
use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WorksController extends Controller
{
    public function history()
    {
        return view('works.history');
    }

    public function postPage()
    {
        return view('works.post');
    }

    public function postWork(Request $request)
    {
        // Save artwork
        $path = $request->file('art')->store('art');
        $artwork = new Artwork();
        $artwork->name = $request->title;
        $artwork->description = $request->description;
        $artwork->URI = $path;
        $artwork->userID = Auth::user()->id;
        $artwork->published_to = json_encode(['provider' => 'pending']);
        $artwork->save();

        $twitter = $request->boolean('twitter') ? "twitter" : "";

        // Mass Post
        $provider = Provider::where("userID", Auth::user()->id)->where("type", $twitter)->get();
        Log::info($provider);
        $mp = new MassPoster();
        $responses = $mp->post($artwork, $provider);
        return view("works.history");

    }
}

