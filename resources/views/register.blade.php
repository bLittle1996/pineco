@extends('layouts/master')

@section('title')
  login
@endsection

@section('body')

  @include('includes/header')

  <section class="login-and-registration-form">
    <div class="wrapper-narrow">
    <form action="" method="post" class="input-form">
      <h1>register</h1>
      <input type="text" placeholder="username" name="username" />
      <input type="email" placeholder="email" name="email" />
      <input type="password" placeholder="password" name="password" />
      <input type="password" placeholder="confirm password" name="password_confirm" />
      <button class="button primary" type="submit" name="submit">register</button>
      <input type="hidden" name="_token" value="{{ csrf_token() }}"
    </form>
    </div>
  </section>

  @include('includes/footer')

@endsection
