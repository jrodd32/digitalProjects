<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
    }

    /**
     * Show the goal dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('goals/index');
    }

    public function goals()
    {
        return response()->json([
            '0' => [
                'name' => 'goal 1',
                'description' => 'goal 1 description'
            ],
            '1' => [
                'name' => 'goal 2',
                'description' => 'goal 2 description'
            ]
        ]);
    }
}
