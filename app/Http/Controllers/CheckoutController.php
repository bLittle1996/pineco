<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Cart;
use App\userShippingInfo;

class CheckoutController extends Controller
{
  public function getShippingInfo() {
    $shippingInformation = Auth::user()->userShippingInfo()->get();
    return response()->json($shippingInformation);
  }

  public function getCheckout() {
    if(count(Auth::user()->cart()->get()) == 0) {
      return redirect()->back();
    }
    $cart = Cart::where('user_id', Auth::user()->id)->first();//since each user only has one cart, we can use first to avoid running into issues with how get() returns an array!
    $total = 0;
    foreach($cart->products as $product) {
      $total += $product->price * $product->pivot->quantity;
    }

    return view('user/checkout', ['total' => $total]);
  }

  public function proceedToPayment(Request $request) {
    $this->validate($request, [
      'name' => 'required',
      'address' => 'required',
      'city' => 'required',
      'state' => 'required',
      'country' => 'required',
      'postal_code' => 'required',
      'phone' => 'required'
    ]);

    if($request['save_shipping_info'] != null) {
      try{
        $newShippingInfo = new userShippingInfo();
        $newShippingInfo->name = $request['name'];
        $newShippingInfo->address = $request['address'];
        $newShippingInfo->city = $request['city'];
        $newShippingInfo->state = $request['state'];
        $newShippingInfo->country = $request['country'];
        $newShippingInfo->postal_code = $request['postal_code'];
        $newShippingInfo->phone = $request['phone'];
        Auth::user()->userShippingInfo()->save($newShippingInfo);
      } catch(\Exception $ex) {
        //it did not save the users shipping info, since it will never serve a function they don't need to know that...
      }
    }

    return view('user/payment', ['total' => $request['total']]);
  }

  public function handlePayment(Request $request) {
    return Auth::user()->charge($request['amountInCents'], [
      "currency" => "cad",
      "source" => $request['stripeToken'],
      "description" => "your pine.co order"
    ]);
  }
}
