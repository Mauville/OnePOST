<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ScheduledWork;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledController extends Controller
{
    public function showScheduled()
    {
        $scheduled_works = Auth::user()->scheduled;
        return view('scheduled.list', compact('scheduled_works'));
    }

    public function deleteConfirmation(ScheduledWork $scheduled) {
        return view("scheduled.deleteConfirmation", compact('scheduled'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     *
     */
    public function deleteScheduled(ScheduledWork $scheduled, Request $request)
    {
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
}

