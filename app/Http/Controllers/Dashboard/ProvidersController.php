<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

//     Function for receiving POST with auth
//     Funciton for receiving POST with new art
//     Create art with DB
}


