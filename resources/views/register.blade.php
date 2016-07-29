@extends('layouts/master')

@section('title')
  login
@endsection

@section('body')

  @include('includes/header')

  <section class="login-and-registration-form">
    <div class="wrapper-narrow">
    <form action="{{ route('register') }}" method="post" class="input-form">
      <h1>register</h1>
      <input type="text" placeholder="username" name="username" />
      <input type="email" placeholder="email" name="email" />
      <input type="password" placeholder="password" name="password" />
      <input type="password" placeholder="confirm password" name="password_confirm" />
      <button class="button primary" type="submit" name="submit">register</button>
      @if(count($errors) > 0)
        <ul class="errors">
          @foreach($errors->all() as $error)
          <li>{{ strtolower(substr($error, 0, strlen($error) - 1)) }}</li>
        @endforeach
        </ul>
      @endif
      <input type="hidden" name="_token" value="{{ Session::token() }}" />
    </form>
    </div>
  </section>

  @include('includes/footer')

@endsection
