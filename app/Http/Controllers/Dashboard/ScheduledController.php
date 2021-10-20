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

    public function deletePermanently(ScheduledWork $scheduled)
    {
        $scheduled->delete();
        return redirect()->route('dashboard.scheduled.show');
    }
}

