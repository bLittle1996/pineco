@extends('layouts/master')

@section('title')
  payment
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper" id="checkout">
    <h1>give money</h1>
    <div class="panel">
      <p>At this point you probably think our site is pretty sketchy, and we certainly don't blame you for feeling that way, and you probably don't trust us with handling your credit card information.</p>
      <p>Luckily, we don't trust ourselves with that responsibility either! We use a payment system called <a href='https://www.stripe.com'>Stripe</a> which securely lets you make quick, easy, and secure payments online, securely. <strong>So it's their fault, <em>not ours</em>, if something goes wrong.</strong></p>
      <p>Click the button below to pay for your order through <a href='https://www.stripe.com'>Stripe</a>!</p>
      <form id='payment-form' action="{{ route('handlePayment') }}" method="POST">
        <script
          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="pk_test_82SbUiIklcrUrNUvJCqTOrqJ"
          data-email="{{ Auth::user()->email }}"
          data-amount="{{ $total * 100 }}"
          data-name="pine.co"
          data-description="your order"
          data-label="pay ${{ number_format($total, 2) }}"
          data-locale="auto"
          data-currency="cad">
        </script>
        <input type='hidden' name='_token' value="{{ Session::token() }}">
        <input type='hidden' name='amountInCents' value="{{ $total * 100 }}">
      </form>
    </div>
  </div>
  @include('includes/footer')
@endsection
