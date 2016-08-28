@extends('layouts/master')

@section('title')
  cart
@endsection

@section('body')
  <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
  <script src="{{ URL::to('javascript/cart.js') }}"></script>
  @include('includes/header')
  <div class="wrapper" id='cart'>
    <h1>cart</h1>
    <div class="panel">
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
            <td></td>
          </tr>
          @foreach($cart->products as $product)
            <tr id="{{ $product->id }}">
              <td class='name'>{{ $product->name }}</td>
              <td class='quantity'><i class="fa fa-minus-square-o"></i>  <div>{{ $product->pivot->quantity }}</div>  <i class="fa fa-plus-square-o"></i></td>
              <td class='price'>${{ number_format($product->price, 2) }}</td>
              <td class='total'>${{ number_format($product->pivot->quantity * $product->price,2) }}</td>
              <td><i class="fa fa-remove"></i></td>
            </tr>
          @endforeach
        </table>
        </div>
        <div class="cart-functions">
          <a class="button-small primary" href="{{ route('checkout') }}">checkout</a>
        </div>
        <input type='hidden' id='token' name='_token' value='{{ Session::token() }}'
      @endif
    </div>
  </div>
  @include('includes/footer')
@endsection
