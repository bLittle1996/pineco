@extends('layouts/master')

@section('title')
  verification
@endsection

@section('body')
  @include('includes/header')
  @if(Session::get('username') == null || Session::get('email') == null)
    <script>window.location.href = "{{ route('home') }}";</script>
  @endif
  <div class="wrapper-narrow panel" id="verify">
    <h1>thanks for registering your new pine.co account, {{ Session::get('username') }}</h1>
    <p>you're so close to being able to begin experience the wonders that pine.co offers</p>
    <p>all that's left now is the verify your account, you can do that by clicking a link we've emailed you at {{ Session::get('email') }}</p>
    <p>didn't receive an email? <a href="#">click here to send it again</a></p>
  </div>
  @include('includes/footer')
@endsection
