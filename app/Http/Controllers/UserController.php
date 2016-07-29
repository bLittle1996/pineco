<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Mail;
use App\User;
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

  public function getVerify() {
    return view('verification/verify')->with(['username' => null, 'email' => null]);
  }

  public function getVerificationReminder() {
    return view('verification/verificationRequired');
  }

  public function getVerificationSuccess() {
    return view('verification/confirmedVerification');
  }

  public function getVerificationFailed() {
    return view('verification/failedVerification');
  }

  public function loginUser(Request $request) {
    //let's validate the request, is there a password? a username? are these things even in the db?
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    if( !Auth::attempt(['username' => strtolower($request['username']), 'password' => $request['password']]) ) {
      return redirect()->back()->with(['fail' => 'unable to login, invalid username or password']);
    }
    //so if we could login, check to see if we are verified(confirmed). If not, redirect them to a page letting them know they gotta do that if they want to login
    else if(Auth::user()->confirmed === false){
      Auth::logout();
      return redirect()->route('verificationRequired')->with(['email' => User::where('username', '=', $request['username'])->first()['email']]);
    }
    //otherwise we just login and have a gander
    return redirect()->route('profile');
  }

  public function registerUser(Request $request) {

    $this->validate($request, [
      'username' => 'required|unique:users',
      'email' => 'required|unique:users|email',
      'password' => 'required|min:8|same:password_confirm'
    ]);
                                      //tells this closure to take the $request variable from the function parameter
    DB::transaction(function() use ($request) {
      $user = new User();
      $user->username = strtolower($request['username']);
      $user->email = $request['email'];
      $user->confirmation_token = str_random(64);
      $user->password = bcrypt($request['password']);
      $user->save();
      Mail::send('emails/verify',  ['user' => $user], function($message) use ($user){
        $message->to($user['email'], $user['username'])->subject('verify your pine.co account');
        $message->from('noreply@pine.co', 'Pine.co Team');
      });
    });

    //after we register the use in the DB, redirect them to the landing page for now. In the future put them at the catalog or to some verify email screen
    return redirect()->route('verify')->with(['username' => $request['username'], 'email' => $request['email']]);
  }

  public function verifyAccount($confirmation_token) {
    try {
      $user = User::where('confirmation_token', '=', $confirmation_token)->first();
      $user->confirmed = true;
      $user->save();
    }
    catch(Exception $ex) {
        return redirect()->route('failedVerification')->with(['success' => 'failed']);
    }
    return redirect()->route('confirmedVerification')->with(['success' => 'success']);
  }

  public function logoutUser() {
    Auth::logout();
    return redirect()->back();
  }
}
