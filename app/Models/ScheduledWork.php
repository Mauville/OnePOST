<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledWork extends Model
{
    use HasFactory;

    public static function fromRequest(Request $request): ScheduledWork
    {
        $path = $request->file('art')->store('art');
        $scheduled = new ScheduledWork();
        $scheduled->name = $request->name;
        $scheduled->description = $request->description;
        $scheduled->URI = $path;
        $scheduled->userID = Auth::user()->id;
        $scheduled->time_scheduled = $request->time_scheduled;
        $scheduled->save();
        return $scheduled;
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }
}
