<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Basecamp authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('37signals')->redirect();
    }

    /**
     * Obtain the user information from Basecamp.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('37signals')->user();
        return response()->json($user);
        // $user->token;
    }
}
