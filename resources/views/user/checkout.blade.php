@extends('layouts/master')

@section('title')
  checkout
@endsection

@section('body')
  <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
  <script src='{{ URL::to('javascript/checkout.js') }}'></script>
  @include('includes/header')
  <div class="wrapper" id="checkout">
    <h1>checkout</h1>
    <div class="panel">
      <form action="{{ route('proceedToPayment') }}" method="post">
        <h2>shipping info (non-functional, for show)</h2>
        <div class="inputs_total_container">
          <div class="inputs">
            <input name='name' placeholder='enter name' type='text' />
            <input name='address' placeholder='enter address' type='text' />
            <input name='city' placeholder='enter city' type='text' />
            <input name='state' placeholder='enter state/province' type='text' />
            <input name='country' placeholder='enter country' type='text' />
            <input name='postal_code' placeholder='enter postal code' type='text' />
            <input name='phone' placeholder='enter phone' type='text' />
            <input type='checkbox' name='save_shipping_info' /><label for='save_shipping_info'>save this info for next time?</label>
            <input type='hidden' name="_token" value="{{ Session::token() }}" />
            <input type='hidden' name='total' value='{{ $total }}' />
          </div>
          <div class="total">
            <p>your total is:</p>
            <p class='amount'>${{ number_format($total, 2) }}</p>
          </div>
        </div>
        <div class='errors_and_buttons'>
          <button class='button-small primary' type='submit'>proceed to payment</button>
          @if(count($errors) > 0)
            @foreach($errors->all() as $error)
              <p class='error'>{{ strtolower(substr($error, 0, strlen($error) - 1)) }}</p>
            @endforeach
          @endif
        </div>
      </form>
    </div>
  </div>
  @include('includes/footer')
@endsection
