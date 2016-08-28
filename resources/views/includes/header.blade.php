<header class="clearfix green-header">
  <div class="wrapper-wide">
    <a href="{{ route('home') }}" class="sitename">pine.co</a>

    <nav>
      <ul>
        <li><a href="{{ route('catalog') }}">browse</a></li>
        @if(!Auth::check())
          <li><a href="{{ route('login') }}">login</a></li>
          <li><a href="{{ route('registration') }}" class="button-small secondary">register</a></li>
        @else
          <li><a href="{{ route('cart') }}">cart</a></li>
          <li><a href="{{ route('logout') }}" class="button-small secondary">logout</a></li>
        @endif
      </ul>
    </nav>
  </div>
</header>
