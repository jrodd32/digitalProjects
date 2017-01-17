<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;
use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->User = new User;
    }
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
        $user = $this->User->findOrCreateBasecampUser(
            Socialite::driver('37signals')->user()
        );

        auth()->login($user);
        return redirect('/');
    }
}
