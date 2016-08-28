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
    <h1>uh-oh</h1>
    <p>something went wrong with your activation</p>
    <a href="#">click here to send it again</a>
  </div>
  @include('includes/footer')
@endsection
