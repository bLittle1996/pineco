<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Cart;
use Auth;
use DB;

class CartController extends Controller
{
  public function addToCart(Request $request) {
    if($request['quantity'] == '' || $request['quantity'] <= 0) {
      $request['quantity'] = 1;
    }
    DB::beginTransaction();
    try {
      $cart = Cart::where('user_id', Auth::user()->id)->first();
      $found = false;//product exists in cart already?
      //check to see if the user already has the product in their cart, so that we can increment the quantity field of a single entry in the db instead of creating a new one
      foreach($cart->products as $product) {
        if($product->pivot->product_id == $request['product_id']) {
          $found = true;
          break;
        }
      }

      if($found) {
        $cart->products()->updateExistingPivot($request['product_id'], ['quantity' => DB::table('cart_product')->where('product_id', $request['product_id'])->first()->quantity + $request['quantity']]);
      } else {
        $cart->products()->attach($request['product_id'], ['quantity' => $request['quantity']]);
      }

      DB::commit();
      return redirect()->back()->with(['message' => 'added item to cart!']);
    } catch(\Exception $e) {
      DB::rollback();
      return redirect()->back()->with(['message' => 'failed to add item to cart: ' . $e->getMessage()]);
    }
  }

  public function getCart() {
    $cart = Cart::where('user_id', Auth::user()->id)->with('products')->first();
    return view('user/cart', ['cart' => $cart]);
  }
}
