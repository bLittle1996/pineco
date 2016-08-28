@extends('layouts/master')

@section('title')
  verified!
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper-narrow panel verify">
    @if(Session::get('success') == null)
      <script>window.location.href = "{{ route('home') }}";</script>
    @endif
    <h1>you're now verified!</h1>
    <p>you can now access the wonders that we offer, ranging from actually buying wonderful products to leaving scathing reviews</p>
  </div>
  @include('includes/footer')
@endsection
