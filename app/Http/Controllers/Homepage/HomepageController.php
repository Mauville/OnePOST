<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {

        /*
        if (auth()->user() !== null) {
            return redirect()->route('dashboard.homepage');
        }
         */

        return view('homepage.index');
    }
}
