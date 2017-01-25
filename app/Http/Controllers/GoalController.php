<?php

namespace App\Http\Controllers;

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
            'type' => 'required'
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
            'description' => $request->description,
            'type' => $request->type
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
        $goal->type = $request->type;
        if ($goal->save()) {
            return response()->json('Goal Saved');
        } else {
            return response()->json('error');
        }
    }

    public function delete(int $id)
    {
        $goal = Goal::find($id);
        if (!$goal->delete()) {
            return response()->json('Error: Goal Not Deleted');
        }

        return response()->json('Goal Deleted');
    }
}
