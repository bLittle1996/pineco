@extends('layouts/master')

@section('title')
  verification required
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper-narrow panel verify">
    <h1>whoa, you gotta verify yourself before you can login</h1>
    <p>didn't receive an email?</p>
    <a href="{{ URL::to('verify/resend/' . Session::get('username')) }}">click here to send it again</a>
  </div>
  @include('includes/footer')
@endsection
