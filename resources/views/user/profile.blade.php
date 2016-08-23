@extends('layouts/master')

@section('title')
  profile
@endsection

@section('body')

  @include('includes/header')

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
          <li>change username</li>
          <li>change email</li>
          <li>change password</li>
          <li>change shipping info</li>
        </ul>
      </div>

      <div class="order-history outline">
        <h3>order history</h3>
        you haven't ordered anything, get on that please
      </div>
    </div>
  </section>

  @include('includes/footer')

@endsection
