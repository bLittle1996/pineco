<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

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
