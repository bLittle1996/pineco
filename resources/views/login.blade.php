@extends('layouts/master')

@section('title')
  login
@endsection

@section('body')

  @include('includes/header')

  <section class="login-and-registration-form">
    <div class="wrapper-narrow">
    <form action="" method="post" class="input-form">
      <h1>login</h1>
      <input type="text" placeholder="email or username" name="username" />
      <input type="password" placeholder="password" name="password" />
      <button class="button primary" type="submit" name="submit">login</button>
      <input type="hidden" name="_token" value="{{ csrf_token() }}"
    </form>
    </div>
  </section>

  @include('includes/footer')

@endsection
