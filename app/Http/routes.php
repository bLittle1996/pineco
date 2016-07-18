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


//home group, contains all the views the visitors can see
Route::group(['prefix' => '/'], function(){

  Route::get('/', function () {
    return view('landingpage');
  });//returns either landing page or redirects to catalog based on criteria TBD

});//home group ends
