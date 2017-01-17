<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the users profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile/index');
    }
}
