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
    'middleware' => 'guest',
    'as' => 'login'
  ]);
  Route::post('/login', [
    'uses' => 'UserController@loginUser',
    'as' => 'login'
  ]);
  /* The register routes can have the guest middleware, this means that you can only access these if you aren't authenticated(logged in) */
  Route::get('/register', [
    'uses' => 'UserController@getRegistrationPage',
    'middleware' => 'guest',
    'as' => 'registration'
  ]);
  Route::post('/register', [
    'uses' => "UserController@registerUser",
    'middleware' => 'guest',
    'as' => 'register'
  ]);

  Route::group(['prefix' => 'verify'], function() {
    Route::get('/', [
      'uses' => 'VerifyController@getVerify',
      'as' => 'verify'
    ]);
    Route::get('/activate/{confirmation_token}', [
      'uses' => "VerifyController@verifyAccount",
      'as' => 'verifyAccount'
    ]);
    Route::get('/required', [
      'uses' => "VerifyController@getVerificationReminder",
      'as' => 'verificationRequired'
    ]);
    Route::get('/failed', [
      'uses' => "VerifyController@getVerificationFailed",
      'as' => 'failedVerification'
    ]);
    Route::get('/confirmed', [
      'uses' => "VerifyController@getVerificationSuccess",
      'as' => 'confirmedVerification'
    ]);
  });
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
