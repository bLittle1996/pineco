<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//home group, contains all the basic pages visitors can see. Such as a landing page, the login page, the registration page, and so on
Route::group(['prefix' => '/'], function() {

  Route::get('/', function () {
    return view('landingpage');
  })->name('home');//returns either landing page or redirects to catalog based on criteria TBD

  Route::get('/login', [
    'uses' => 'UserController@getLoginPage',
    'as' => 'login'
  ]);

  Route::post('/login', [
    'uses' => 'UserController@loginUser',
    'as' => 'login'
  ]);




  Route::get('/register', [
    'uses' => 'UserController@getRegistrationPage',
    'as' => 'registration'
  ]);

  //the auth middleware we see here, basically means that a user has to be logged in and authenticated in order to access it
  Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/', [
      'uses' => 'UserController@getProfile',
      'as' => 'profile'
    ]);

    Route::get('/logout', [
      'uses' => 'UserController@logoutUser',
      'as' => 'logout'
    ]);
  });
});//home group ends
