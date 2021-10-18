<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvidersController extends Controller
{
    public function showProviders()
    {
        $providers = Auth::user()->providers;
        return view('providers.providers', compact('providers'));
    }

    public function register()
    {
        return view('providers.register');
    }

    public function deleteConfirmation(Provider $provider) {
        return view("providers.deleteConfirmation", compact('provider'));
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
    public function deleteProvider(Provider $provider, Request $request)
    {
        $provider->delete();
        return redirect()->route('dashboard.providers.show');
    }
}


