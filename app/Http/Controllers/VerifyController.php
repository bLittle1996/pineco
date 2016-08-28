<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Mail;

class VerifyController extends Controller
{
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

  public function resendVerificationEmail($username) {
    try {
      $user = User::where('username', $username)->firstOrFail();
      if($user->confirmed == true) {
        //if the user is already confirmed, just redirect to the landingpage
        return redirect()->route('login');
      }
      $user->confirmation_token = str_random(64);
      $user->save();
      Mail::send('emails/verify',  ['user' => $user], function($message) use ($user){
        $message->to($user['email'], $user['username'])->subject('verify your pine.co account');
        $message->from('noreply@pine.co', 'Pine.co Team');
      });
      return redirect()->route('verify')->with(['email' => $user->email, 'username' => $user->username]);
    } catch(\Exception $ex) {
      return redirect()->route('login');
    }
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
}
