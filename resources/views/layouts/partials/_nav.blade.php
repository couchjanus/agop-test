<!-- Sidebar  -->
<div id='cart' class="cart">
  <div id="dismiss" class="dismiss">
    <i class="fas fa-arrow-right"></i>
  </div>
  <div class="cart-header">
    Your Shopping Cart
  </div>
  <div class="cart-items"></div>
  <div class='total'>
    <div class='subtotalTotal'>Subtotal <span>$0.00</span></div>
    <div class='taxes'>Tax <span>$0.00</span></div>
    <div class='shipping'>Shipping <span>$0.00</span></div>
    <div class='finalTotal'>Total <span>$0.00</span></div>
    <a class='checkout'>Check Out</a>
    <a class="clear-cart">Clear Cart</a>
    <p class='error'></p>
  </div>
</div>

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
      </div>
      <a class='cart-link' href='#menu'>
          <span class='cart-text'><i class="fas fa-cart-plus"></i>
          <span>Cart</span>
          </span>
          <span class='returnToShop'>&larr; Back</span>
          <span class='cart-quantity empty'>0</span>
      </a>
    </div>
  </nav>
<div class="overlay"></div>
  