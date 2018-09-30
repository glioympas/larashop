<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('products.index') }}">LaraSHOP</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('products.shoppingCart')}}"><i class="fas fa-shopping-cart"></i> Shopping Cart
          <span id="itemsAmmount"><span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></span>
        </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> @if(Auth::check()) {{ Auth::user()->email }} @else User Management @endif<span class="caret"></span></a>
          <ul class="dropdown-menu">

            @if(Auth::check())
                  <li><a href="{{ route('users.profile') }}">Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ route('users.logout') }}">Logout</a></li>
            @else
                <li><a href="{{ route('users.signup') }}">Sign Up</a></li>
                <li><a href="{{ route('users.signin') }}">Sign In</a></li>
            @endif
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>