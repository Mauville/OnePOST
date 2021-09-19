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
        $providers = Provider::where("userID", Auth::user()->id)->where("type", $twitter)->get();
        Log::info($providers);
        $mp = new MassPoster();
        $responses = $mp->post($artwork, $providers);
        return view("works.history");

    }

    public function deleteWork(Request $request)
    {
//        A controller to delete posts. The request needs two fields:
//        An artwork ID
//        A provider type (hardcoded to twitter in this case)
        $artwork = Artwork::find($request->id);
        $provider = Provider::where("userid", Auth::user()->id)->where("type", "twitter")->get();
        $mp = new MassPoster();
        $responses = $mp->delete($artwork, $provider);
        $artwork . delete();
        return view("works.history");
    }
}

