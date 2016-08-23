@extends('layouts/master')

@section('title')
  product
@endsection
@section('body')
  @include('includes/header')
  <div class="wrapper">
    <div class="panel" id="product-panel">
      <div class="product-name">
        <h1>{{ $product->name }}</h1>
      </div>
      <div class="product-information">
        <div class="product-images"><img src="{{ URL::to($product->thumbnail) }}"></div>
        <div class="product-description">
          <p>{{ $product->short_desc }}</p>
        </div>
        <div class="product-price">${{ $product->price }}</div>
      </div>
      <form method="post" action="{{ route('addToCart') }}" class="product-functions">
        <input name="quantity" type="number" placeholder="quantity" step="1" min="1" max="{{ $product->quantity }}" />
        <input type="hidden" value="{{ $product->id }}" name="product_id" />
        <button type="submit" class="button primary">add to cart</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}" />
      </form>
      @if(Session::has('message'))
        <div class="message">
          <p>{{ Session::get('message') }}</p>
        </div>
      @endif

    </div>

    @if($product->long_desc != null)
      <div class="panel" id="detailed_desc">
        <h1>more info</h1>
        <div class="custom-html">
          {!! $product->long_desc !!}
        </div>
      </div>
    @endif
    <div class="panel" id="reviews">
      <h1>reviews</h1>
      @if(count($product->reviews) == 0)
        <div class="reviews">
          <div class="review">
            <p>this product doesn't have any reviews yet :(</p>
            <p>be the first to leave one</p>
          </div>

          <div class="review">
            @if(!Auth::check())
              <p class="need-login">you must be <a href="{{ route('login') }}">logged in</a> to leave a review</p>
            @else
              <form method="post" action="{{ route('postReview') }}">
                <h2>you</h2> <h3>(
                  <select name="rating">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>/5) say...</h3>
                  <textarea name="message" placeholder="leave your review"></textarea>
                  <div class="button-container">
                    <button class="button-small primary" type="submit" name="submit">leave review</button>
                  </div>
                  <input name="product_id" type="hidden" value="{{ $product->id }}" />
                  <input name="_token" type="hidden" value="{{ Session::token() }}" />
                  @if(count($errors) > 0)
                    <ul class="errors">
                      @foreach($errors->all() as $error)
                        <li>{{ strtolower(substr($error, 0, strlen($error) - 1)) }}</li>
                      @endforeach
                    </ul>
                  @endif
                </form>
              @endif
            </div>
          </div>
        @else
          <div class="reviews">
            <div class="review">
              @if(!Auth::check())
                <p class="need-login">you must be <a href="{{ route('login') }}">logged in</a> to leave a review</p>
              @else
                <form method="post" action="{{ route('postReview') }}">
                  <h2>you</h2> <h3>(
                    <select name="rating">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>/5) say...</h3>
                    <textarea name="message" placeholder="leave your review"></textarea>
                    <div class="button-container">
                      <button class="button-small primary" type="submit" name="submit">leave review</button>
                    </div>
                    <input name="product_id" type="hidden" value="{{ $product->id }}" />
                    <input name="_token" type="hidden" value="{{ Session::token() }}" />
                  </form>
                @endif
              </div>
              @foreach($product->reviews as $review)
                <div class="review">
                  <h2>{{ $review->user->username }}</h2> <h3>(<span class="green">{{ $review->rating }}</span>/5) says...</h3>
                  <p>{{ $review->message }}</p>
                  <p class="date">{{ explode(' ', $review->created_at)[0] }}</p>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
    @include('includes/footer')
  @endsection
