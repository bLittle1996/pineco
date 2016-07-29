@extends('layouts/master')

@section('title')
  welcome
@endsection

@section('body')
  <section class="banner">
    <div class="wrapper-wide">
      <header class="clearfix">
        <a href="{{ route('home') }}" class="sitename">pine.co</a>

        <nav>
          <ul>
            <li><a href="#">browse</a></li>
            @if(!Auth::check())
              <li><a href="{{ route('login') }}">login</a></li>
              <li><a href="{{ route('registration') }}" class="button-small secondary">register</a></li>
            @else
              <li><a href="{{ route('logout') }}" class="button-small secondary">logout</a></li>
            @endif
          </ul>
        </nav>
      </header>

      <div class="content">
        <h1>the world's leading supplier of <span class="enhance-weight">pinecones</span></h1>
        <h3>become a part of the greatest thing since greatness and start <em>pining</em> over our quality pinecones and pinecone accessories</h3>
        <div class="button-container">
          <a class="button secondary" href="#"> browse </a>
          <a class="button primary" href="{{ route('registration') }}">register</a>
        </div>
      </div>
    </div>
  </section>

  <section class="info-panels">
    <div class="wrapper-wide">
      <div class="info-panel">
        <h1>stellar customer service</h1>
        <p>our automated systems are so advanced that it seems as if a genuine, real human is helping you! we take your issues very seriously, and strive to resolve them in at least 2-3 years</p>
        <a class="button-small primary" href="#service-info">learn more</a>
      </div>
      <div class="info-panel">
        <h1>huge variety</h1>
        <p>we source our products from a huge number of coniferous species from all over the world so that you are certain you will find just what you are looking for</p>
        <a class="button-small primary" href="#variety-info">learn more</a>
      </div>
      <div class="info-panel">
        <h1>exclusive rewards</h1>
        <p>our earth-shattering, sky-sundering, sea-splitting rewards system the likes of which the world has never seen the likes of which helps you, yes <em>you</em>, to get exclusive on all of our products</p>
        <a class="button-small primary" href="#rewards-info">learn more</a>
      </div>
    </div>
  </section>

  <section class="useless-brown-section">
    <div class="wrapper-narrow">
      <div class="no-info-section" id="service-info">
        <h1>stellar customer service</h1>
        <p>our automated systems are so advanced that it seems as if a genuine, real human is helping you!
          we take your issues very seriously, and strive to resolve them in at least 2-3  years.
          when shopping here at pine.co, you can be sure that any issues you have can be resolved quickly and painlessly!</p>
        </div>
        <div class="no-info-section" id="variety-info">
          <h1>huge variety</h1>
          <p>we source our products from a huge number of coniferous species from all over the world so that you are certain you will find just what you are looking for
            <br><br>
            there is nothing more to learn</p>
          </div>
          <div class="no-info-section" id="rewards-info">
            <h1>exclusive rewards</h1>
            <p>our earth-shattering, sky-sundering, sea-splitting rewards system the likes of which the world has never seen the likes of which helps you, yes you, to get exclusive discounts on all our products!
              but how? <br>
              for each dollar you spend you earn a certain amount of pointcones which can be spent just like regular cash, just with a better exchange rate than the Canadian dollar!</p>
            </div>
          </div>

        </section>

        <section class="call-to-action">
          <div class="wrapper-narrow">
            <h1>start earning exclusive rewards<br><em>today</em></h1>
            <a href="{{ route('registration') }}" class="button-large primary">register</a>
            <p>Ben Littleton &copy; {{ getdate()['year'] }}
          </div>
        </section>
      @endsection
