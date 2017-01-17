<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\User;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the users profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('profile/index');
    }
}
