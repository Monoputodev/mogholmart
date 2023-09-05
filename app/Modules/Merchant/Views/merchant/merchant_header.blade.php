<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area d-flex justify-content-between align-items-center">
        <!-- Contact Info -->
        <div class="contact-info">
            <a href="#"><span>Hotline : </span> +880 1610000056</a>
            <a href="#"><span>Email:</span> info@zinismart.com.bd</a>
        </div>
        <!-- Follow Us -->
        <div class="follow-us merchant-top-header">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">


                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                  {{$varifaid_user->shop_name}} ({{Auth::user()->email}})
              </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ route('merchant.profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('merchant.resetpassword', $varifaid_user->id) }}">Change Password</a>
                        <a class="dropdown-item" href="{{route('merchant.logout')}}">Sign Out</a>
                    </div>
                </div>
            </div>
            <!-- <a href="#"><img class="flag" src=" {{ asset('frontend/img') }}/flag/bn.jpg"></a>
            <a href="#"><img class="flag" src=" {{ asset('frontend/img') }}/flag/en.jpg"></a> -->
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="clever-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="cleverNav">

                <!-- Logo -->
                <a class="nav-brand" href="{{URL::to('/')}}"><img src="{{ asset('logo/zinismart.png') }}" class="logo-img"></a>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- Close Button -->
                    <div class="classycloseIcon soniaclassycloseIcon">
                        <div class="soniaclosemenu">Menu</div>
                        <div class="cross-wrap soniacross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav-merchant">
                        <ul>

                            <li><a class="<?=Route::currentRouteName()=='merchant.dashboard'? 'active-hover-m':'active-m'?>" href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                          
                            @if($varifaid_user->merchant_agreement=="yes")
                                <li><a class="<?=Route::currentRouteName()=='merchant.order.index'? 'active-hover-m':'active-m'?>" href="{{ route('merchant.order.index') }}" >My Order</a></li>

                                <li><a  class="<?=Route::currentRouteName()=='merchant.my.product'? 'active-hover-m':'active-m'?>" href="{{ route('merchant.my.product') }}" >My Product</a></li>

                                <li><a href="#">My Payment</a></li>

                                <li><a  class="<?=Route::currentRouteName()=='merchant.comission.details'? 'active-hover-m':'active-m'?>" href="{{ route('merchant.comission.details') }}">Comission Order Info</a></li>
                            @endif
                        </ul>

                    </div>
                    <!-- Nav End -->

                </div>

            </nav>
        </div>
    </div>

</header>