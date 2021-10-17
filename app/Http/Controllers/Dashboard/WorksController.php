<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Build artwork
        $artwork = Artwork::fromRequest($request);

        // Lookup networks to post to
        $networks = array_keys($request->input("network"));

        // Mass Post
        $providers = Auth::user()->providers()->whereIn("type", $networks)->get();
        foreach ($providers as $provider) {
            $provider->createPost($artwork);
        }
        return view("works.history");

    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     *
     * A controller to delete works.
     *
     * The request needs two fields:
     *
     * An artwork ID with name "artworkID"
     * A provider type (hardcoded to default twitter in this case) with name "provider"
     *
     * NOTE: Since we don't want the user to painstakingly delete an image from each network manually, a checkbox for each network is needed.
     * This changes the provider field into an array that's derived from a <fieldset>
     * Refer to post.blade.php's checkboxes fieldset to see how proper naming works.
     * uncomment line 1) and comment line 2) when the proper structure has been implemented on the view.
     */
    public function deleteWork(Request $request)
    {

//        // 1)
//        $networks = array_keys($request->input("network"));
        // 2)
        $networks = $request->boolean('provider') ? "" : "twitter";

        $artwork = Artwork::find($request->artworkID);
        $providers = Auth::user()->providers()->whereIn("type", $networks)->get();
        foreach ($providers as $provider) {
            $provider->deletePost($artwork);
        }
        $artwork->delete();
        return view("works.history");
    }
}

