<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Products</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
               <li>
                   <div class="pull-right clearfix">
              <a href="/cart/view">
                <!--  <i class="fa fa-shopping-cart" aria-hidden="true"></i> -->
                <div class="pull-left" style="margin-right: -80px; margin-top: 3px;">
                <img src="{{ asset('cartImages/cartImg.png' )}}" class="img-responsive" height="35%" width="35%" >
                </div>
                <div class="pull-right">
              <button class="btn btn-default btn-warning" style="margin-top: 8px; margin-right: 5px;" > ({{ count(\Session::get('product')) }}) ITEM(S)</button>
              </div>
              </a>
              </div>
               </li>
                <!-- <li>
                    <a href="">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                        <span class="badge"></span>
                    </a>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                         @if(Auth::check())
                            <li><a href="{{ route('user.profile') }}">User Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('user.logout') }}">Logout</a></li>
                        @else
                            <li><a href="{{ route('user.signup') }}">Signup</a></li>
                            <li><a href="{{ route('user.signin') }}">Signin</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>