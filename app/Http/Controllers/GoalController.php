<?php

namespace App\Http\Controllers;

use App\User;
use App\Goal;
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
        return response()->json(Goal::all());
    }

    public function save(Request $request)
    {
        $goal = Goal::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'data' => $goal
        ]);
    }

    public function edit(Request $request)
    {
        $goal = Goal::find($request->id);
        $goal->name = $request->name;
        $goal->description = $request->description;
        if ($goal->save()) {
            return response()->json('Goal Saved');
        } else {
            return response()->json('error');
        }
    }
}
