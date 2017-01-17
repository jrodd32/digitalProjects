<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Basecamp OAuth
Route::get('/auth/basecamp', 'Auth\AuthController@redirectToProvider');
Route::get('/auth/basecamp/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('/', 'HomeController@index');
Route::get('/goals', 'GoalController@index')->middleware('auth');
Route::get('/profile', 'ProfileController@index')->middleware('auth');
Route::get('/logout', function () {
    Auth::logout();

    return redirect('/');
});