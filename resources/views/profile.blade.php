@extends('layouts/master')

@section('title')
  profile
@endsection

@section('body')

  @include('includes/header')

  logged in as {{ Auth::user()->username }} ({{ Auth::user()->email }})

  @include('includes/footer')

@endsection
