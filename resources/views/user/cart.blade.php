@extends('layouts/master')

@section('title')
  cart
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper" id='cart'>
    <div class="panel">
      <h1>cart</h1>
      @if(count($cart->products) == 0)
        <p class="empty">you don't have anything in your cart right now, please fix that</p>
      @else
        <div class="table-container">
        <table>
          <tr>
            <td><h2>product<h2></td>
            <td style="text-align: right;"><h2>quantity<h2></td>
            <td style="text-align: right;"><h2>price<h2></td>
            <td style="text-align: right;"><h2>total<h2></td>
          </tr>
          @foreach($cart->products as $product)
            <tr>
              <td class='name'>{{ $product->name }}</td>
              <td class='quantity'>{{ $product->pivot->quantity }}</td>
              <td class='price'>${{ $product->price }}</td>
              <td class='total'>${{ $product->pivot->quantity * $product->price }}</td>
            </tr>
          @endforeach
        </table>
        </div>
        <div class="cart-functions">
          <a class="button-small primary" href="#">checkout</a>
        </div>
      @endif
    </div>
  </div>
  @include('includes/footer')
@endsection
