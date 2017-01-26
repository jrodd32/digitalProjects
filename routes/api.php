<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/goals', 'GoalController@goals')->middleware('auth:api');
Route::post('/goal-save', 'GoalController@save')->middleware('auth:api');
Route::put('/goal-edit', 'GoalController@edit')->middleware('auth:api');
Route::delete('/goal-delete/{id}', 'GoalController@delete')->middleware('auth:api');

// Route::get('/profile', function (Request $request) {
//     return $request->user();
// })->middleware('auth');

Route::get('/profile', function (Request $request) {
    return response()->json(Auth::user());
})->middleware('auth:api');