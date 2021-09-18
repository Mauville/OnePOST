<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class OAuthController extends Controller
{

    /*
    use AuthenticatesUsers;

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('homepage');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make($user->token),
                    'google_id' => $user->user['id']
                ]);

                Auth::login($newUser);
                return redirect()->route('homepage');
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('auth.google');
        }
    }
}
