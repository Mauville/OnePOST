<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function showProviders() {
        return view('providers.providers');
    }

    public function register() {
        return view('providers.register');
    }
}


