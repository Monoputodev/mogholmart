<?php
if(Session::has('cart')){
  $cart_item_count = count(Session::get('cart'));
  $cart_total = Session::get('cart_total')['total'];
}else{
  $cart_item_count = 0;
  $cart_total = 0;
}
?>

<header class="header shop">
  <!-- Topbar -->
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
          <!-- Top Left -->
          <div class="top-left">
            <ul class="list-main">
              <li><i class="ti-headphone-alt"></i> {{config('global.MOBILE_NO')}}</li>
              <li><i class="ti-email"></i> {{config('global.EMAIL_NAME')}}</li>
            </ul>
          </div>
          <!--/ End Top Left -->
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <!-- Top Right -->
          <div class="right-content">
            <ul class="list-main">


              @if(Auth::user())

              <li><i class="ti-user"></i> <a href="{{route('customer.dashboard')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a></li>

              <li>
                <a href="{{route('customer.logout')}}"><i class="ti-lock"></i>Logout</a>
              </li>
              @else
              <li>
                <a href="{{route('web.customer.account')}}"><i class="ti-user"></i>My Account</a>
              </li>
              @endif

              <li><i class="ti-power-off"></i><a href="{{route('web.customer.register')}}">Sign Up</a></li>
            </ul>
          </div>
          <!-- End Top Right -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Topbar -->
  <div class="middle-inner">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-2">
          <!-- Logo -->
          <div class="dotMenuIcon" data-toggle="modal" data-target="#popupTopbar">
            <ul class="icons btn-left showLeft">
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>
          <div class="logo">
            <a href="{{URL::to('/')}}">
                @if(Session::has('main_logo'))
                <?php  $main_logo = Session::get('main_logo'); ?>
                <img src="{{URL::to('uploads/generel_file/')}}/{{$main_logo->value}}" class="main-logo">
                @endif
              </a>
          </div>
          <!--/ End Logo -->
          <!-- Search Form -->
          <div class="search-top">
            <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
            <!-- Search Form -->
            <div class="search-top">

                 {!! Form::open(['method' =>'GET', 'route' => 'web.search', 'class' => 'search-form']) !!}
                <input name="keywords" placeholder="Search Here....." type="search" value="<?php if(isset($_GET["keywords"])){ echo $_GET['keywords']; } ?>">
                <button value="search" type="submit"><i class="ti-search"></i></button>
              {!! Form::close() !!}
            </div>
            <!--/ End Search Form -->
          </div>

          <div class="cart-top">
            <div class="top-cart"><a href="#0"><i class="ti-bag"></i><span class="total-count" id="total_items2">{{$cart_item_count}}</span></a></div>
            <!-- Search Form -->
            <div class="cart-top">
              <div class="cart-form">

                <div class="shopping-item" id="cart_summary_ajax2">
                  <?php
                  $cart_items = [];
                  if(Session::has('cart')){
                    $cart_items = Session::get('cart');
                  }
                  ?>

                  @if(count($cart_items) > 0)
                  <div class="dropdown-cart-header">
                    <span>{{$cart_item_count}} Items</span>
                    <a href="{{ route('web.my.cart') }}">View Cart</a>
                    <i class="ti-close" id="closecart"></i>
                  </div>
                  <ul class="shopping-list cart-scroll">

                   @foreach($cart_items as $cart)
                   <li>
                    <a href="#" product_id="{{$cart['product_id']}}" class="remove close-item" title="Remove this item"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="{{route('product.slug',['slug' => $cart['product_slug']])}}">
                      @if(isset($cart['image_link']))
                      <img  src="{{$cart['product_image']}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" style="height: 40px;width: 40px">
                      @else
                      <img  data-sizes="auto" src="{{URL::to('logo/nofound.png')}}"  alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" style="height: 40px;width: 40px">
                      @endif
                    </a>

                    <h4><a href="{{route('product.slug',['slug' => $cart['product_slug']])}}">{{$cart['product_title']}}</a></h4>
                    <p class="quantity">{{$cart['product_quantity']}}x - <span class="amount">{{__('messages.tk')}} {{number_format($cart['sell_price'], 0)}}</span></p>
                  </li>
                  @endforeach

                </ul>

                <div class="bottom">
                  <div class="total">
                    <span>Total</span>
                    <span class="total-amount">{{__('messages.tk')}} {{ $cart_total }}</span>
                  </div>
                  <a href="{{route('web.cart.checkout')}}" class="btn animate">Checkout</a>
                </div>

                @else
                <div class="dropdown-cart-header">
                  <span>Your shopping cart is empty!</span>
                </div>
                @endif
              </div>
              </div>

            </div>
            <!--/ End Search Form -->
          </div>
          <!--/ End Search Form -->
          <div class="mobile-nav"></div>
        </div>
        <div class="col-lg-7 col-md-7 col-12">
          <div class="search-bar-top">
           {!! Form::open(['method' =>'GET', 'route' => 'web.search', 'class' => '']) !!}
           <div class="search-bar">
            <select name="search_option">
              <option value="all">All Category</option>
     
              @if(Session::has('category_menu'))
              <?php  $categorys = Session::get('category_menu'); ?>
              @if(count($categorys) > 0)
              @foreach($categorys as $category)
              <option <?=isset($_GET['search_option']) && $_GET['search_option'] == $category['name'] ? 'selected': '';?> value="{{$category['name']}}">{{$category['name']}}</option>
              @endforeach
              @endif
              @endif
            </select>
            <input name="keywords" placeholder="Search Products Here....." type="search" value="<?php if(isset($_GET["keywords"])){ echo $_GET['keywords']; } ?>">
            <button class="btnn" type="submit"><i class="ti-search"></i></button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>


      <div class="col-lg-2 col-md-3 col-12">
        <div class="right-bar">
          <!-- Search Form -->
          <div class="sinlge-bar">
            <?php
            $wishlist_count = 0;
            if(\Auth::user()){
              $wishlist_count = DB::table('wishlist')->where('users_id',Auth()->user()->id)->count();
            }
            ?>
            <a href="{{ route('customer.wishlist') }}" class="single-icon" title="Wishlist">
              <i class="fa fa-heart-o" aria-hidden="true"></i><span class="total-count" id="wishlist_item_count">{{$wishlist_count}}</span></a>
            </a>
          </div>



          <div class="sinlge-bar shopping">
            <a href="#" class="single-icon"><i class="ti-bag"></i> <span class="total-count" id="total_items">{{$cart_item_count}}</span></a>
            <!-- Shopping Item -->

            <div class="shopping-item" id="cart_summary_ajax">
              <?php
              $cart_items = [];
              if(Session::has('cart')){
                $cart_items = Session::get('cart');
              }
              ?>

              @if(count($cart_items) > 0)
              <div class="dropdown-cart-header">
                <span>{{$cart_item_count}} Items</span>
                <a href="{{ route('web.my.cart') }}">View Cart</a>
              </div>
              <ul class="shopping-list cart-scroll">

               @foreach($cart_items as $cart)
               <li>
                <a href="#" product_id="{{$cart['product_id']}}" class="remove close-item" title="Remove this item"><i class="fa fa-remove"></i></a>
                <a class="cart-img" href="{{route('product.slug',['slug' => $cart['product_slug']])}}">
                  @if(isset($cart['image_link']))
                  <img  src="{{$cart['product_image']}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" sizes="50px">
                  @else
                  <img  data-sizes="auto" src="{{URL::to('logo/nofound.png')}}"  alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" sizes="50px">
                  @endif
                </a>

                <h4><a href="{{route('product.slug',['slug' => $cart['product_slug']])}}">{{$cart['product_title']}}</a></h4>
                <p class="quantity">{{$cart['product_quantity']}}x - <span class="amount">{{__('messages.tk')}} {{number_format($cart['sell_price'], 0)}}</span></p>
              </li>
              @endforeach

            </ul>

            <div class="bottom">
              <div class="total">
                <span>Total</span>
                <span class="total-amount">{{__('messages.tk')}} {{ $cart_total }}</span>
              </div>
              <a href="{{route('web.cart.checkout')}}" class="btn animate">Checkout</a>
            </div>

            @else
            <div class="dropdown-cart-header">
              <span>Your shopping cart is empty!</span>
            </div>
            @endif
          </div>


          <!--/ End Shopping Item -->
        </div>
      </div>
    </div>


  </div>
</div>
</div>
<!-- Header Inner -->
<div class="header-inner">
  <div class="container">
    <div class="cat-nav-head">
      <div class="row">
        <div class="col-12">
          <div class="menu-area">
            <!-- Main Menu -->
            <nav class="navbar navbar-expand-lg">
              <div class="navbar-collapse">
                <div class="nav-inner">
                  <ul class="nav main-menu menus navbar-nav">
    {{-- <li><a href="{{ URL::to('/') }}">Home</a></li> --}}
    @if(Session::has('category_menu'))
        <?php $categorys = Session::get('category_menu'); ?>
        @if(count($categorys) > 0)
            @foreach($categorys as $category)
                <li>
                    <a href="{{route('category.slug', ['slug' => $category['slug']])}}">
                        {{$category['name']}}
                        @if(isset($category['sub_menu']) && count($category['sub_menu']) > 0)
                            <i class="ti-angle-down"></i>
                        @endif
                    </a>
                    @if(isset($category['sub_menu']) && count($category['sub_menu']) > 0)
                        <ul class="dropdown">
                            @foreach($category['sub_menu'] as $sub_category)
                                <li>
                                    <a href="{{route('category.child.slug', [
                                            'main_category_slug' => $category['slug'],
                                            'slug' => $sub_category['slug']
                                        ])}}">
                                        {{$sub_category['name']}}
                                        @if(isset($sub_category['sub_menu']) && count($sub_category['sub_menu']) > 0)
                                            <i class="ti-angle-right"></i>
                                        @endif
                                    </a>
                                    @if(isset($sub_category['sub_menu']) && count($sub_category['sub_menu']) > 0)
                                        <ul class="dropdown sub-dropdown">
                                            @foreach($sub_category['sub_menu'] as $sub_category2)
                                                <li>
                                                    <a href="{{route('category.child.child.slug', [
                                                            'main_category_slug' => $category['slug'],
                                                            'child_category_slug' => $sub_category['slug'],
                                                            'slug' => $sub_category2['slug']
                                                        ])}}">
                                                        {{$sub_category2['name']}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    @endif
</ul>

               </div>
             </div>
           </nav>
           <!--/ End Main Menu -->
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<!--/ End Header Inner -->
</header>

