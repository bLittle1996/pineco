@extends('layouts/master')

@section('title')
  change username
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper" id='update-user-form'>
    <h1>change password</h1>
    <div class="panel">
      <form action="{{ route('updatePassword') }}" method='post'>
        <input type="password" placeholder='enter new password' name='newPassword'>
        <input type="password" placeholder='confirm new password' name='passwordConfirm'>
        <input type='text' placeholder='enter code' name='token'>
        <input type='hidden' name='_token' value='{{ Session::token() }}'>
        <p>don't have a token? click the button below to have a new one emailed to you</p>
        <button type='submit' class='button-small primary'>update password</button>
      </form>
      <form action="{{ route('generatePasswordToken') }}" method='post'>
        <input type='hidden' name='_token' value='{{ Session::token() }}'>
        <button type='submit' class='button-small primary'>get a token</button>
      </form>
      @if(count($errors) > 0)
        @foreach($errors->all() as $error)
          <p class='error-msg'>{{ strtolower(substr($error, 0, strlen($error) - 1)) }}</p>
        @endforeach
      @endif
      @if(Session::has('success'))
        <p class='success-msg'>{{ Session::get('success') }}</p>
      @elseif(Session::has('error'))
        <p class='error-msg'>{{ Session::get('error') }}</p>
      @endif
    </div>
  </div>
  @include('includes/footer')
@endsection
