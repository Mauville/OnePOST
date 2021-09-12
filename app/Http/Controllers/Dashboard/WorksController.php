<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorksController extends Controller
{
    public function history() {
        return view('works.history');
    }

    public function post() {
        return view('works.post');
    }
}

