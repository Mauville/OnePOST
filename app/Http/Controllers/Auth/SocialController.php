<?php

namespace App\Http\Controllers\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{


    // This is the three-legged-Oauth for getting post privileges from user account.
    // The steps are:
    // 1) Get OAuth token for Dev keys.
    // 2) Let user auth our app on Twitter Front-End. We get User Keys.
    // 3) Get OAuth perma-token for User keys.
    // 4) Save this token into DB and Tweet Away!

    public function twitterRedirect()
    {
        // This function takes care of steps 1) and 2), sending the user to Twitter land for them to give us permissions.


        $connection = new TwitterOAuth(config("twitter.consumer_key"), config("twitter.consumer_secret"));
        // 1) Get OAuth token for Dev keys.
        $devkeys = $connection->oauth("oauth/request_token");
        session(["oauth_token", $devkeys["oauth_token"]]);
        // 2) Let user auth our app on Twitter Front-End. We get User Keys.
        $url = $connection->url("oauth/authorize", ["oauth_token" => $devkeys["oauth_token"]]);
        return redirect($url);
    }

    public function twitterCallback(Request $request)
    {
        $connection = new TwitterOAuth(config("twitter.consumer_key"), config("twitter.consumer_secret"));
        // After user auths, Twitterland send back the OAuth perma-tokens on a request.
        // This takes us back to 3)
        // The request contains an oauth_token and an oauth_verifier
        $headers = ["oauth_consumer_key" => config("twitter.consumer_key"),
            "oauth_token" => $request["oauth_token"],
            "oauth_verifier" => $request["oauth_verifier"]
        ];
        // We're finally on 4)! We convert user keys into user oauth token and store it
        $access_token = $connection->oauth("oauth/access_token", $headers);
        $p = new Provider();
        $p->userID = Auth::user()->id;
        $p->type = "twitter";
        $p->token = $access_token["oauth_token"];
        $p->token_secret = $access_token["oauth_token_secret"];
        $p->save();
        return redirect()->route('homepage');
    }
}
