@extends('layouts/master')

@section('title')
  change username
@endsection

@section('body')
  @include('includes/header')
    <div class="wrapper" id='update-user-form'>
      <h1>change username</h1>
      <div class="panel">
        <form action="{{ route('updateUsername') }}" method='post'>
          <input type="text" placeholder='enter new username' name='newUsername'>
          <input type='hidden' name='_token' value='{{ Session::token() }}'>
          <button type='submit' class='button-small primary'>update username</button>
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
        </form>
      </div>
    </div>
  @include('includes/footer')
@endsection
