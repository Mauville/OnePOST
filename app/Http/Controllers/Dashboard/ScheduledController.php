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

    public function changePage(ScheduledWork $scheduled)
    {
        $providers = Auth::user()->providers;
        return view('scheduled.change', compact('providers', 'scheduled'));
    }

    public function changeScheduled(Request $request, ScheduledWork $scheduled)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'providersId' => 'required|array',
            'time_scheduled' => 'required|date'
        ]);

        // Lookup networks to post to
        $ids = array_keys($data['providersId']);

        // Find if the user has artworks
        $providers = Auth::user()->providers()->whereIn("id", $ids)->get();
        if ($providers->isEmpty()) { 
            return redirect()->route('dashboard.scheduled.show');
        }

        // Scheduling artworks instead of creating them
        $new_scheduled = ScheduledWork::fromRequest($request, $scheduled->URI);
        // We only create a relation into future providers posts.
        foreach ($providers as $provider) {
            $new_scheduled->providers()->attach($provider->id);
        }

        // Drop previous scheduled after changes saved in new.
        $scheduled->delete();
        return redirect()->route('dashboard.scheduled.show');
    }

    public function deleteConfirmation(ScheduledWork $scheduled) {
        return view("scheduled.deleteConfirmation", compact('scheduled'));
    }

    public function deletePermanently(ScheduledWork $scheduled)
    {
        $scheduled->delete();
        return redirect()->route('dashboard.scheduled.show');
    }
}

