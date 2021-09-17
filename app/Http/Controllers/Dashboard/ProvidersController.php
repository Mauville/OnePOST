<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function showProviders()
    {
        return view('providers.providers');
    }

    public function register()
    {
        return view('providers.register');
    }

//     Function for receiving POST with auth
//     Funciton for receiving POST with new art
//     Create art with DB
}


