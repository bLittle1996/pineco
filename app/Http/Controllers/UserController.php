<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
  public function getLoginPage() {
    return view('login');
  }

  public function getRegistrationPage() {
    return view('register');
  }

  public function getProfile() {
    return view('profile');
  }

  public function loginUser(Request $request) {
    //let's validate the request, is there a password? a username? are these things even in the db?
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    if( !Auth::attempt(['username' => $request['username'], 'password' => $request['password']]) ) {
      return redirect()->back()->with(['fail' => 'unable to login, invalid username or password']);
    }

    return redirect()->route('profile');
  }

  public function logoutUser(){
    Auth::logout();
    return redirect()->back();
  }
}
