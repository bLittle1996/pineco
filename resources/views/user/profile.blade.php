@extends('layouts/master')

@section('title')
  profile
@endsection

@section('body')

  @include('includes/header')
  <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
  <script src="{{ URL::to('javascript/profile.js') }}"></script>
  <section class="panel wrapper" id="profile">
    <div class="panel-header">
      <h1>profile</h1>
      <h3>{{ Auth::user()->username }}</h3>
      <h5>{{ Auth::user()->email }}</h5>
    </div>
    <div class="account-content clearfix">
      <div class="account-settings outline">
        <h3>account settings</h3>
        <ul>
          <li><a href="{{ route('getChangeUsername') }}">change username</a></li>
          <li><a href='{{ route('getChangePassword') }}'>change password</a></li>
          <li>change shipping info</li>
        </ul>
      </div>

      <div class="order-history outline">
        <h3>order history</h3>
        <div id="orders-table">you haven't ordered anything, get on that please</div><script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
        <script src="{{ URL::to('javascript/cart.js') }}"></script>
      </div>
    </div>
  </section>

  @include('includes/footer')

@endsection
