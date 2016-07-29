@extends('layouts/master')

@section('title')
  verification required
@endsection

@section('body')
  <div class="wrapper-narrow panel">
    <h1>whoa, you gotta verify yourself before you can login</h1>
    <p>didn't receive an email?</p>
    <a href="#">click here to send it again</a>
  </div>

@endsection
