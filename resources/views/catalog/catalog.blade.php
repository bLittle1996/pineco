@extends('layouts/master')

@section('title')
  catalog
@endsection

@section('body')
  @include('includes/header')
  <div class="wrapper-wide" id="catalog">
    <div class="catalog-child">
      @foreach($inventory as $category => $products)
        <div class="category" id="{{ str_replace(' ', '_', $category) }}">
          <h1>{{ $category }}</h1>
          <div class="clearfix">
            <div class="arrows-left">
              @if($products->currentPage() != 1)
                <a href="{{ $products->appends($appends)->fragment(str_replace(' ', '_', $category))->previousPageUrl() }}"><img src="{{ URL::to('images/icons/arrows-left.png') }}" alt="a pair of gorgeous arrows point to the left" /></a>
              @else
                <img src="{{ URL::to('images/icons/arrows-left-disabled.png') }}" alt="a pair of gorgeous arrows point to the left" />
              @endif
            </div>
            <div class="products">
              @foreach($products as $product)
                <div class="product">
                  <a href="#">
                    <img src="{{ URL::to($product->thumbnail) }}" />
                    <div class="product-info">
                      <p class="product-name">{{ $product->name }}</p>
                      <p class="product-price">${{ $product->price }}</p>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>

            <div class="arrows-right">
              @if($products->hasMorePages())
                <a href="{{ $products->appends($appends)->fragment(str_replace(' ', '_', $category))->nextPageUrl() }}"><img src="{{ URL::to('images/icons/arrows-right.png') }}" alt="a pair of gorgeous arrows point to the right" /></a>
              @else
                <img src="{{ URL::to('images/icons/arrows-right-disabled.png') }}" alt="a less gorgeous pair of arrows pointing right" />
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @include('includes/footer')
@endsection
