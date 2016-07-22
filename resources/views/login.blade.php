@extends('layouts/master')

@section('title')
  login
@endsection

@section('body')

  @include('includes/header')

  <section class="login-and-registration-form">
    <div class="wrapper-narrow">
    <form action="{{ route('login') }}" method="post" class="input-form">
      <h1>login</h1>
      <input type="text" placeholder="username" name="username" />
      <input type="password" placeholder="password" name="password" />
      <button class="button primary" type="submit" name="submit">login</button>
      @if(count($errors) > 0)
        <ul class="errors">
          @foreach($errors->all() as $error)
          <li>{{ strtolower(substr($error, 0, strlen($error) - 1)) }}</li>
        @endforeach
        </ul>
      @endif
      @if(Session::has('fail'))
        <ul class="errors">
          <li>{{ Session::get('fail') /*In the controller I am returning to the session an array with the key of 'fail', which has a message as it's value. */ }}</li>
        </ul>
      @endif
      <input type="hidden" name="_token" value="{{ Session::token() }}"/>
    </form>
    </div>
  </section>

  @include('includes/footer')

@endsection
