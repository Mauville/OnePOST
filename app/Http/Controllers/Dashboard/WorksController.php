<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ScheduledWork;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Exports\ArtworkExport;
use Maatwebsite\Excel\Facades\Excel;

class WorksController extends Controller
{
    public function history()
    {
        $artworks = Auth::user()->artworks;

        // Updates stats
        foreach ($artworks as $artwork)
        {
            $artwork->stats = $artwork->getStatistics();
            // Hacer suma
            $total = 0;
            foreach ($artwork->stats as $stat)
            {
                if ($stat)
                {
                    $stat_sum = 0;
                    foreach($stat as $value)
                    {
                        $stat_sum += $value;
                    }
                    $total += $stat_sum;
                }
            }
            $artwork->totalstats = $total;
            $artwork->save();
        }

        // Hacer update
        return view('works.history', compact('artworks'));
    }

    public function postPage()
    {
        $providers = Auth::user()->providers;
        return view('works.post', compact('providers'));
    }

    public function searchWork(Request $request)
    {
        $data = $request->validate([
            'searchField' => 'required'
        ]);

        $searchField = $data['searchField'];
        $artworks = Auth::user()->artworks()->where('name', 'like', $searchField . '%')->get();
        return view('works.history', compact('artworks'));
    }

    public function sortWorks(Request $request)
    {
        $data = $request->validate([
            'sortBy' => 'required',
            'order' => 'required'
        ]);

        $sortBy = $data['sortBy'];
        $order = $data['order'];

        switch ($sortBy) {
        case 'stats':
            $artworks = Auth::user()->artworks()->orderBy('totalstats', $order)->get();
            break;
        case 'dateCreated':
            $artworks = Auth::user()->artworks()->orderBy('created_at', $order)->get();
            break;
        case 'name':
            $artworks = Auth::user()->artworks()->orderBy('name', $order)->get();
            break;
        default:
            return redirect()->route('dashboard.works.history');
        }
        foreach ($artworks as $artwork)
        {
            $artwork->stats = $artwork->getStatistics();
        }
        return view('works.history', compact('artworks'));
    }

    public function postWork(Request $request)
    {
        $data = $request->validate([
            'art' => 'required|mimes:jpg,png,gif,mp4',
            'name' => 'required',
            'description' => 'required',
            'providersId' => 'required|array',
            'shouldSchedule' => 'numeric',
            'time_scheduled' => 'date'
        ]);

        // Save image
        $path = Storage::putFile('artworks', $request->file('art'));


        // Lookup networks to post to
        $ids = array_keys($data['providersId']);

        // Find if the user has artworks
        $providers = Auth::user()->providers()->whereIn("id", $ids)->get();
        if ($providers->isEmpty()) {
            return redirect()->route('dashboard.works.history');
        }

        // Scheduling artworks instead of creating them
        if (isset($data['shouldSchedule'])) {
            $scheduled = ScheduledWork::fromRequest($request, $path);
            // We only create a relation into future providers posts.
            foreach ($providers as $provider) {
                $scheduled->providers()->attach($provider->id);
            }
            return redirect()->route('dashboard.scheduled.show');
        }

        // Create artwork and mass post.
        $artwork = Artwork::fromRequest($request, $path);
        foreach ($providers as $provider) {
            $provider->createPost($artwork);

        }

        return redirect()->route('dashboard.works.history');

    }

    public function repostPage(Artwork $artwork)
    {
        $providers = Auth::user()->providers;
        return view('works.repost', compact('artwork', 'providers'));
    }

    public function repostWork(Request $request, Artwork $artwork)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'providersId' => 'required|array',
            'shouldSchedule' => 'numeric',
            'time_scheduled' => 'date'
        ]);

        // Lookup networks to post to
        $ids = array_keys($data['providersId']);

        // Find if the user has artworks
        $providers = Auth::user()->providers()->whereIn("id", $ids)->get();
        if ($providers->isEmpty()) {
            return redirect()->route('dashboard.works.history');
        }

        // Scheduling artworks instead of creating them
        if (isset($data['shouldSchedule'])) {
            $scheduled = ScheduledWork::fromRequest($request, $artwork->URI);
            // We only create a relation into future providers posts.
            foreach ($providers as $provider) {
                $scheduled->providers()->attach($provider->id);
            }
            return redirect()->route('dashboard.scheduled.show');
        }

        // Create artwork and mass post.
        $artwork = Artwork::fromRequest($request, $artwork->URI);
        foreach ($providers as $provider) {
            $provider->createPost($artwork);
        }

        return redirect()->route('dashboard.works.history');

    }

    public function deleteConfirmation(Artwork $artwork) {
        return view("works.deleteConfirmation", compact('artwork'));
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
    public function deleteWork(Artwork $artwork, Request $request)
    {

//        // 1)
//        $networks = array_keys($request->input("network"));
        // 2)
        $data = $request->validate([
            'providersId' => 'required|array',
        ]);

        // Lookup networks to post to
        $ids = array_keys($data['providersId']);

        // Find if the user has artworks
        $providers = $artwork->providers()->whereIn("provider_id", $ids)->get();
        foreach ($providers as $provider) {
            $provider->deletePost($artwork);
        }
        return redirect()->route('dashboard.works.history');
    }

    public function deletePermanently(Artwork $artwork)
    {
        $artwork->delete();
        return redirect()->route('dashboard.works.history');
    }

    public function exportCsv()
    {
        return Excel::download(new ArtworkExport(Auth::user()), 'artworks.csv');
    }
}

