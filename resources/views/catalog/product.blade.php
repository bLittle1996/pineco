@extends('layouts/master')

@section('title')
  product
@endsection

@section('body')
  @include('includes/header')
  {{ $productInfo }}
  @include('includes/footer')
@endsection
