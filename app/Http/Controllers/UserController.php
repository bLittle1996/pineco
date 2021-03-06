<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Mail;
use App\User;
use App\Cart;
class UserController extends Controller {
  public function getLoginPage() {
    return view('login');
  }
  public function getRegistrationPage() {
    return view('register');
  }
  public function getProfile() {
    return view('user/profile');
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
      return redirect()->route('verificationRequired')->with(['username' => User::where('username', '=', $request['username'])->first()['username']]);
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
      $cart = new Cart();
      $user->cart()->save($cart);
      Mail::send('emails/verify',  ['user' => $user], function($message) use ($user){
        $message->to($user['email'], $user['username'])->subject('verify your pine.co account');
        $message->from('noreply@pine.co', 'Pine.co Team');
      });
    });
    //after we register the use in the DB, redirect them to the landing page for now. In the future put them at the catalog or to some verify email screen
    return redirect()->route('verify')->with(['username' => $request['username'], 'email' => $request['email']]);
  }

  public function logoutUser() {
    Auth::logout();
    return redirect()->route('login');
  }

  /***** PROFILE FUNCTIONS *****/
  public function getChangeUsername() {
    return view('user/changeUsername');
  }

  public function getChangePassword() {
    return view('user/changePassword');
  }

  public function getOrders() {
    return response()->json(Auth::user()->orders()->with('orderDetails')->orderBy('created_at', 'desc')->get());
  }

  public function changeUsername(Request $request) {
    $this->validate($request, [
      'newUsername' => 'required|unique:users,username'
    ]);
    DB::beginTransaction();
    try {
      $user = Auth::user();
      $user->username = $request['newUsername'];
      $user->save();
      DB::commit();
      return redirect()->back()->with(['success' => 'username successfully updated']);
    } catch(\Exception $ex) {
      DB::rollback();
      return redirect()->back()->with(['error' => 'unable to change username, try again later']);
    }
  }

  public function generatePasswordToken() {
    DB::beginTransaction();
    try {
      $user = Auth::user();
      $user->password_token = str_random(7);
      $user->save();
      Mail::send('emails/passwordChange', ['user' => $user], function ($m) use ($user) {
        $m->to($user->email, $user->username)->subject('pine.co password change confirmation');
        $m->from('noreply@pine.co', 'Pine.co Team');
      });
      DB::commit();
      return redirect()->back()->with(['success' => 'please check your email to receive your code']);
    } catch(\Exception $ex) {
      DB::rollback();
      return redirect()->back()->with(['error' => 'unable to send email, try again later']);
    }
  }

  public function changePassword(Request $request) {
    $this->validate($request, [
      'newPassword' => 'min:8|required|same:passwordConfirm',
      'token' => 'required'
    ]);
    DB::beginTransaction();
    try {
      $user = Auth::user();
      if($user->password_token == $request['token']) {
        $user->password = bcrypt($request['newPassword']);
        $user->password_token = null;
        $user->save();
        DB::commit();
        return redirect()->back()->with(['success' => 'password succesfully updated']);
      }
      return redirect()->back()->with(['error' => 'token invalid']);
    } catch(\Exception $ex) {
      DB::rollback();
      return redirect()->back()->with(['error' => 'unable to update password, servers caught fire']);
    }
  }

}
