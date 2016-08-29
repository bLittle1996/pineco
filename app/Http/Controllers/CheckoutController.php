<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Cart;
use App\UserShippingInfo;
use App\Order;
use App\OrderDetail;
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
    if($request['save_shipping_info'] != null) {
      try {
        $this->validate($request, [
          'name' => 'required',
          'address' => 'required',
          'city' => 'required',
          'state' => 'required',
          'country' => 'required',
          'postal_code' => 'required',
          'phone' => 'required'
        ]);
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
    $order = new Order();
    $order->total_paid = $request['amountInCents'] / 100;
    $orderDetails = [];
    foreach(Auth::user()->cart()->first()->products as $product) {
      $orderDetail = new OrderDetail();
      $orderDetail->product_id = $product->id;
      $orderDetail->price_per_unit = $product->price;
      $orderDetail->quantity = $product->pivot->quantity;
      $orderDetails[] = $orderDetail;
    }

    Auth::user()->orders()->save($order);
    $order->orderDetails()->saveMany($orderDetails);

    Auth::user()->cart()->first()->products()->detach();

    Auth::user()->charge($request['amountInCents'], [
      "currency" => "cad",
      "source" => $request['stripeToken'],
      "description" => "your pine.co order"
    ]);

    return redirect()->route('profile');
  }
}
