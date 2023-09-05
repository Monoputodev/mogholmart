@extends('Web::layouts.master')

@section('body')


    @php
        use App\Modules\Admin\Models\Advertisement;

    @endphp
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v8.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    ` <style>
        .my-text {
            text-align: left;
            /* Default text alignment for all devices */
        }

        @media (max-width: 767px) {

            /* Text alignment for devices with a maximum width of 767px (i.e., mobile devices) */
            .my-text {
                text-align: center;
            }

            .MT-2 {
                margin-top: .6rem;
            }
        }

        #item {
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  transition: all 0.2s ease-in-out;
}

#item:hover {
  transform: translate(0, -2px);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

    </style>

    <!-- Your Chat Plugin code -->

    @include('Web::home.slider')
    <!-- Start Small Banner  -->
    <section class="small-banner section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $advertisement_one = Advertisement::where('type', '1')
                        ->orderby('id', 'desc')
                        ->where('status', 'active')
                        ->first();
                    ?>
                    @if (count($advertisement_one) > 0)
                        <a href="{{ $advertisement_one->short_order }}" title="{{ $advertisement_one->title }}"><img
                                src="{{ URL::to('uploads/advertisement') }}/{{ $advertisement_one->image_link }}"
                                alt="{{ $advertisement_one->title }}" class="bannerimage"></a>
                    @endif
                </div>
                <div class="col-md-6">
                    <?php
                    $advertisement_two = Advertisement::where('type', '2')
                        ->orderby('id', 'desc')
                        ->where('status', 'active')
                        ->first();
                    ?>
                    @if (count($advertisement_two) > 0)
                        <a href="{{ $advertisement_two->short_order }}" title="{{ $advertisement_two->title }}"><img
                                src="{{ URL::to('uploads/advertisement') }}/{{ $advertisement_two->image_link }}"
                                alt="{{ $advertisement_two->title }}" class="bannerimage"></a>
                    @endif
                </div>
            </div>
        </div>

    </section>
    <!-- End Small Banner -->

    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <?php
                $advertisement_4 = Advertisement::where('type', '3')
                    ->orderby('id', 'desc')
                    ->where('status', 'active')
                    ->limit(2)
                    ->get();
                ?>
                @if (count($advertisement_4) > 0)
                    @foreach ($advertisement_4 as $value)
                        <div class="col-md-6">

                            <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                    src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                    alt="{{ $value->title }}" class="bannerimage"></a>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="container">

            {{-- magical area starts from here  --}}
<!--btn-->


            @foreach ($categoryItem as $item)
@if(count($item->products) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                            <div class="card-fs-content-header-left J_FSHeaderLeft">
                                <div class="card-fs-content-header-left-status pull-left">
                                    <div class="fs-status-text" style="color: undefined"> {{ $item->title }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">

                            <div class="tab-content" id="myTabContent">
                                <!-- Start Single Tab -->
                                <div class="tab-pane fade show active" id="man" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="row" id="show_new_data{{ $i }}">
                                                @foreach ($item->products as $product_data)
       
                                                    <?php
                                                    if ($product_data->offer_price > $product_data->sell_price) {
                                                        $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price);
                                                    } else {
                                                        $percentage = 0;
                                                    }
                                                    ?>
                                                    <div id="item" class="col-md-4 col-sm-6 col-6 my-3">
                                                        <div class="card">
                                                            <a target="__blank"
                                                                href="{{ route('product.slug', ['slug' => $product_data->slug]) }}">
                                                                <div class="card-body">
                                                                    <img class="default-img"
                                                                        src="{{ URL::to('uploads/product/' . $product_data->id . '/orginal_image/' . $product_data->image->image) }}"
                                                                        alt="">

                                                                </div>
                                                            </a>
                                                            <strong
                                                                class="card-text ml-4 mb-2">{{ $product_data->title }}</strong>
                                                            {{-- @if (!empty(\Auth::user()))
                                                        <a class="add_to_wishlist"
                                                            data-href="{{ route('customer.add.to.wishlist') }}"
                                                            product-id="{{ $product_data->product_id }}"
                                                            title="Wishlist"> <i
                                                                class="ti-heart"></i><span>Add to
                                                                Wishlist</span> </a>
                                                    @else
                                                        <a class="add-to-cart"
                                                            href="{{ route('web.customer.account') }}"
                                                            target="__blank" title="Wishlist"> <i
                                                                class="ti-heart"></i><span>Add to
                                                                Wishlist</span> </a>
                                                    @endif --}}

                                                            <div class="card-footer">
                                                                <div class="addButtonWrapper border-radius-small row">
                                                                    <div class="col-md-7 col-12 my-text">
                                                                        @if ($product_data->offer_price)
                                                                            <strong>
                                                                                <del class="old text-danger">{{ __('messages.tk') }}
                                                                                    {{ number_format($product_data->offer_price, 0) }}
                                                                                </del>
                                                                            </strong>
                                                                        @endif
                                                                        &nbsp;
                                                                        &nbsp;
                                                                        <strong>{{ __('messages.tk') }}
                                                                            {{ number_format($product_data->sell_price, 0) }}</strong>

                                                                    </div>
                                                                    <div class="col-md-5 MT-2 col-12">
                                                                        @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                                                            <p class="buyText add_cart_ajax" id="cart"
                                                                                product_quantity="1"
                                                                                product_weight="{{ $product_data->weight }}"
                                                                                product_id="{{ $product_data->id }}"
                                                                                product_category_id=""
                                                                                product_merchant_id="{{ $product_data->merchant_id }}"
                                                                                product_image="{{ URL::to('uploads/product/' . $product_data->id . '/orginal_image/' . $product_data->image->image) }}">
                                                                                Add to bag</p>
                                                                        @else
                                                                            <p class="buyText" id="cart-out"><a
                                                                                    href="{{ route('product.slug', ['slug' => $product_data->slug]) }}">Out
                                                                                    of stock</a></p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                  
                                                @endforeach




                                        </div>
                                        <div class="show_more_product{{ $i }}" id="show_more_div{{ $i }}">
                                            <input type="hidden" id="category_id{{ $item->id }}" value="{{  $item->id }}">


                                            <div class="infinite-scrolling-homepage .wow.animated col-md-12"
                                                style="margin-top: 50px;">
                                                <a href="javascript:void(0)" id="btn-more{{ $item->id }}">Show more</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--/ End Single Tab -->

                            </div>
                        </div>
                    </div>

                </div>
          @endif
            @endforeach
            <input type="hidden" id="categoryCount" value="{{ $categoryCount }}">
            {{-- magical area ends from here  --}}


        </div>
    </div>



    <section class="midium-banner">
        <div class="container">
            <div class="row">
                <?php
                $advertisement_4 = Advertisement::where('type', '4')
                    ->orderby('id', 'desc')
                    ->where('status', 'active')
                    ->limit(2)
                    ->get();
                ?>
                @if (count($advertisement_4) > 0)
                    @foreach ($advertisement_4 as $value)
                        <div class="col-md-6">

                            <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                    src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                    alt="{{ $value->title }}" class="bannerimage"></a>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Start Most Popular -->
    {{-- @include('Web::home.hotItem') --}}
    <!-- End Most Popular Area -->
    <section class="midium-banner section">
        <div class="container">
            <div class="row">
                <div class="row">
                    <?php
                    $advertisement_4 = Advertisement::where('type', '5')
                        ->orderby('id', 'desc')
                        ->where('status', 'active')
                        ->limit(2)
                        ->get();
                    ?>
                    @if (count($advertisement_4) > 0)
                        @foreach ($advertisement_4 as $value)
                            <div class="col-md-6">

                                <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                        src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                        alt="{{ $value->title }}" class="bannerimage"></a>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{--
    @if (isset($home_product['category_data']) && !empty($home_product['category_data']))
        @foreach ($home_product['category_data'] as $key => $category_product)
            @if (isset($home_product['product_data'][$category_product['id']]) && !empty($home_product['product_data'][$category_product['id']]))
                <div class="product-area most-popular section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
          <h2>{{$category_product['name']}}</h2>
        </div>
                                <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                                    <div class="card-fs-content-header-left J_FSHeaderLeft">
                                        <div class="card-fs-content-header-left-status pull-left">
                                            <div class="fs-status-text" style="color: undefined">
                                                {{ $category_product['name'] }}</div>
                                        </div>

                                    </div>

                                    <a class="card-fs-content-button J_ShopMoreBtn" title=""
                                        style="color: #f57224; border-color: #f57224"
                                        href="{{ route('category.slug', ['slug' => $category_product['slug']]) }}">SHOP
                                        MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="product-info">

                                    <div class="tab-content" id="myTabContent">
                                        <!-- Start Single Tab -->
                                        <div class="tab-pane fade show active" id="man" role="tabpanel">
                                            <div class="tab-single">
                                                <div class="row" id="show_new_data">
                                                    @if (count($new_product_data) > 0)
                                                        @foreach ($new_product_data as $product_data)
                                                            @php
                                                            if ($product_data->offer_price > $product_data->sell_price) {
                                                                $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price);
                                                            } else {
                                                                $percentage = 0;
                                                            }
                                                            @endphp
                                                            <div class="col-md-4 col-sm-6 col-6">
                                                                <div class="card">
                                                                    <a target="__blank"
                                                                    href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">
                                                                    <div class="card-body">
                                                                        <img class="default-img"
                                                                            src="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}"
                                                                            alt="">

                                                                    </div>
                                                                    </a>
                                                                    <strong class="card-text ml-4 mb-2">{{ $product_data->product_title }}</strong>
                                                                    @if (!empty(\Auth::user()))
                                                                    <a class="add_to_wishlist"
                                                                        data-href="{{ route('customer.add.to.wishlist') }}"
                                                                        product-id="{{ $product_data->product_id }}"
                                                                        title="Wishlist"> <i
                                                                            class="ti-heart"></i><span>Add to
                                                                            Wishlist</span> </a>
                                                                @else
                                                                    <a class="add-to-cart"
                                                                        href="{{ route('web.customer.account') }}"
                                                                        target="__blank" title="Wishlist"> <i
                                                                            class="ti-heart"></i><span>Add to
                                                                            Wishlist</span> </a>
                                                                @endif

                                                                    <div class="card-footer">
                                                                        <div class="addButtonWrapper border-radius-small row">
                                                                            <div class="col-md-7 text-left">
                                                                                @if ($product_data->offer_price)
                                                                                    <strong>
                                                                                        <del class="old text-danger">{{ __('messages.tk') }}
                                                                                            {{ number_format($product_data->offer_price, 0) }}
                                                                                        </del>
                                                                                    </strong>
                                                                                @endif
                                                                                &nbsp;
                                                                                &nbsp;
                                                                                <strong>{{ __('messages.tk') }}
                                                                                    {{ number_format($product_data->sell_price, 0) }}</strong>

                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                                                                    <p class="buyText add_cart_ajax" id="cart"
                                                                                        product_quantity="1"
                                                                                        product_weight="{{ $product_data->weight }}"
                                                                                        product_id="{{ $product_data->product_id }}"
                                                                                        product_category_id=""
                                                                                        product_merchant_id="{{ $product_data->product_merchant_id }}"
                                                                                        product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}">
                                                                                        Add to bag</p>
                                                                                @else
                                                                                    <p class="buyText" id="cart-out"><a
                                                                                            href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">Out
                                                                                            of stock</a></p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                    <div class="show_more_product" id="show_more_div">
                                                        <input type="hidden" name="" id="hidden_number_of_product_show"
                                                            value="6">

                                                        <div class="infinite-scrolling-homepage .wow.animated col-md-12"
                                                            style="margin-top: 50px;">
                                                            <a href="javascript:void(0)" id="btn-more">Show more</a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!--/ End Single Tab -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
 --}}


    <section class="midium-banner section">
        <div class="container">
            <div class="row">
                <?php
                $advertisement_4 = Advertisement::where('type', '6')
                    ->orderby('id', 'desc')
                    ->where('status', 'active')
                    ->limit(2)
                    ->get();
                ?>
                @if (count($advertisement_4) > 0)
                    @foreach ($advertisement_4 as $value)
                        <div class="col-md-6">

                            <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                    src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                    alt="{{ $value->title }}" class="bannerimage"></a>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Start Shop Home List  -->
    {{-- <section class="shop-home-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                        <div class="card-fs-content-header-left J_FSHeaderLeft">
                            <div class="card-fs-content-header-left-status pull-left">
                                <div class="fs-status-text" style="color: undefined">On Sale</div>
                            </div>
                        </div>
                        <a class="card-fs-content-button J_ShopMoreBtn" title=""
                            style="color: #f57224; border-color: #f57224" href="#">SHOP MORE</a>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">

                                <div class="tab-content" id="myTabContent">
                                    <!-- Start Single Tab -->
                                    <div class="tab-pane fade show active" id="man" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row" id="show_new_data">
                                                @if (count($new_product_data) > 0)
                                                    @foreach ($new_product_data as $product_data)
                                                        @php

                                                            if ($product_data->offer_price > $product_data->sell_price) {
                                                                $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price);
                                                            } else {
                                                                $percentage = 0;
                                                            }
                                                        @endphp

                                                        <div class="col-md-4 col-sm-6 col-6">
                                                            <div class="card">
                                                                <a target="__blank"
                                                                href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">
                                                                <div class="card-body">
                                                                    <img class="default-img"
                                                                        src="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}"
                                                                        alt="">

                                                                </div>
                                                                </a>
                                                                <strong class="card-text ml-4 mb-2">{{ $product_data->product_title }}</strong>
                                @if (!empty(\Auth::user()))
                                <a class="add_to_wishlist"
                                    data-href="{{ route('customer.add.to.wishlist') }}"
                                    product-id="{{ $product_data->product_id }}"
                                    title="Wishlist"> <i
                                        class="ti-heart"></i><span>Add to
                                        Wishlist</span> </a>
                            @else
                                <a class="add-to-cart"
                                    href="{{ route('web.customer.account') }}"
                                    target="__blank" title="Wishlist"> <i
                                        class="ti-heart"></i><span>Add to
                                        Wishlist</span> </a>
                            @endif

                                                                <div class="card-footer">
                                                                    <div class="addButtonWrapper border-radius-small row">
                                                                        <div class="col-md-7 text-left">
                                                                            @if ($product_data->offer_price)
                                                                                <strong>
                                                                                    <del class="old text-danger">{{ __('messages.tk') }}
                                                                                        {{ number_format($product_data->offer_price, 0) }}
                                                                                    </del>
                                                                                </strong>
                                                                            @endif
                                                                            &nbsp;
                                                                            &nbsp;
                                                                            <strong>{{ __('messages.tk') }}
                                                                                {{ number_format($product_data->sell_price, 0) }}</strong>

                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                                                                <p class="buyText add_cart_ajax" id="cart"
                                                                                    product_quantity="1"
                                                                                    product_weight="{{ $product_data->weight }}"
                                                                                    product_id="{{ $product_data->product_id }}"
                                                                                    product_category_id=""
                                                                                    product_merchant_id="{{ $product_data->product_merchant_id }}"
                                                                                    product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}">
                                                                                    Add to bag</p>
                                                                            @else
                                                                                <p class="buyText" id="cart-out"><a
                                                                                        href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">Out
                                                                                        of stock</a></p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                                <div class="show_more_product" id="show_more_div">
                                                    <input type="hidden" name="" id="hidden_number_of_product_show"
                                                        value="6">

                                                    <div class="infinite-scrolling-homepage .wow.animated col-md-12"
                                                        style="margin-top: 50px;">
                                                        <a href="javascript:void(0)" id="btn-more">Show more</a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!--/ End Single Tab -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                        <div class="card-fs-content-header-left J_FSHeaderLeft">
                            <div class="card-fs-content-header-left-status pull-left">
                                <div class="fs-status-text" style="color: undefined">Best Seller</div>
                            </div>
                        </div>
                        <a class="card-fs-content-button J_ShopMoreBtn" title=""
                            style="color: #f57224; border-color: #f57224" href="#">SHOP MORE</a>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="product-info">

                                <div class="tab-content" id="myTabContent">
                                    <!-- Start Single Tab -->
                                    <div class="tab-pane fade show active" id="man" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row" id="show_new_data">
                                                @if (count($new_product_data) > 0)
                                                    @foreach ($new_product_data as $product_data)
                                                        @php
                                                        if ($product_data->offer_price > $product_data->sell_price) {
                                                            $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price);
                                                        } else {
                                                            $percentage = 0;
                                                        }
                                                        @endphp
                                                        <div class="col-md-4 col-sm-6 col-6">
                                                            <div class="card">
                                                                <a target="__blank"
                                                                href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">
                                                                <div class="card-body">
                                                                    <img class="default-img"
                                                                        src="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}"
                                                                        alt="">

                                                                </div>
                                                                </a>
                                                                <strong class="card-text ml-4 mb-2">{{ $product_data->product_title }}</strong>
                                @if (!empty(\Auth::user()))
                                <a class="add_to_wishlist"
                                    data-href="{{ route('customer.add.to.wishlist') }}"
                                    product-id="{{ $product_data->product_id }}"
                                    title="Wishlist"> <i
                                        class="ti-heart"></i><span>Add to
                                        Wishlist</span> </a>
                            @else
                                <a class="add-to-cart"
                                    href="{{ route('web.customer.account') }}"
                                    target="__blank" title="Wishlist"> <i
                                        class="ti-heart"></i><span>Add to
                                        Wishlist</span> </a>
                            @endif

                                                                <div class="card-footer">
                                                                    <div class="addButtonWrapper border-radius-small row">
                                                                        <div class="col-md-7 text-left">
                                                                            @if ($product_data->offer_price)
                                                                                <strong>
                                                                                    <del class="old text-danger">{{ __('messages.tk') }}
                                                                                        {{ number_format($product_data->offer_price, 0) }}
                                                                                    </del>
                                                                                </strong>
                                                                            @endif
                                                                            &nbsp;
                                                                            &nbsp;
                                                                            <strong>{{ __('messages.tk') }}
                                                                                {{ number_format($product_data->sell_price, 0) }}</strong>

                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            @if ($product_data->quantity > 0 || $product_data->quantity == null)
                                                                                <p class="buyText add_cart_ajax" id="cart"
                                                                                    product_quantity="1"
                                                                                    product_weight="{{ $product_data->weight }}"
                                                                                    product_id="{{ $product_data->product_id }}"
                                                                                    product_category_id=""
                                                                                    product_merchant_id="{{ $product_data->product_merchant_id }}"
                                                                                    product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}">
                                                                                    Add to bag</p>
                                                                            @else
                                                                                <p class="buyText" id="cart-out"><a
                                                                                        href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">Out
                                                                                        of stock</a></p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                                <div class="show_more_product" id="show_more_div">
                                                    <input type="hidden" name="" id="hidden_number_of_product_show"
                                                        value="6">

                                                    <div class="infinite-scrolling-homepage .wow.animated col-md-12"
                                                        style="margin-top: 50px;">
                                                        <a href="javascript:void(0)" id="btn-more">Show more</a>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!--/ End Single Tab -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                        <div class="card-fs-content-header-left J_FSHeaderLeft">
                            <div class="card-fs-content-header-left-status pull-left">
                                <div class="fs-status-text" style="color: undefined">Top Viewed</div>
                            </div>
                        </div>
                        <a class="card-fs-content-button J_ShopMoreBtn" title=""
                            style="color: #f57224; border-color: #f57224" href="#">SHOP MORE</a>
                    </div>

                    <div class="row">
                        @if (count($most_view) > 0)
                            @foreach ($most_view as $most_data)
                                <!-- Start Single List  -->
                                <div class="col-md-4 col-6">
                                    <div class="single-list">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="list-image overlay">
                                                    @if ($most_data->image != '')
                                                        <img src="{{ URL::to('uploads/product/' . $most_data->product_id . '/200x200/' . $most_data->image) }}"
                                                            class="view_image" alt="">
                                                    @else
                                                        <img class="view_image" src="{{ URL::to('logo/nofound.jpg') }}"
                                                            alt="{{ $most_data->product_title }}">
                                                    @endif
                                                    <a class="buy add_cart_ajax" product_quantity="1"
                                                        product_weight="{{ $most_data->weight }}"
                                                        product_id="{{ $most_data->product_id }}" product_category_id=""
                                                        product_merchant_id="{{ $most_data->product_merchant_id }}"
                                                        product_image="{{ URL::to('uploads/product/' . $most_data->product_id . '/200x200/' . $most_data->image) }}"><i
                                                            class="fa fa-shopping-bag"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 no-padding">
                                                <div class="content">
                                                    <h4 class="title"><a
                                                            href="{{ route('product.slug', ['slug' => $most_data->product_slug]) }}">{{ $most_data->product_title }}</a>
                                                    </h4>
                                                    <p class="price with-discount">{{ __('messages.tk') }}
                                                        {{ number_format($most_data->sell_price, 0) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single List  -->
                            @endforeach
                        @endif
                        <!-- End Single List  -->
                    </div>
                </div>


            </div>
        </div>
    </section> --}}
    <section class="midium-banner section">
        <div class="container">
            <div class="row">
                <?php
                $advertisement_4 = Advertisement::where('type', '7')
                    ->orderby('id', 'desc')
                    ->where('status', 'active')
                    ->limit(2)
                    ->get();
                ?>
                @if (count($advertisement_4) > 0)
                    @foreach ($advertisement_4 as $value)
                        <div class="col-md-6">

                            <a href="{{ $value->short_order }}" title="{{ $value->title }}"><img
                                    src="{{ URL::to('uploads/advertisement') }}/{{ $value->image_link }}"
                                    alt="{{ $value->title }}" class="bannerimage"></a>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- <div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                        <div class="card-fs-content-header-left J_FSHeaderLeft">
                            <div class="card-fs-content-header-left-status pull-left">
                                <div class="fs-status-text" style="color: undefined">Top Brand</div>
                            </div>
                        </div>
                        <a class="card-fs-content-button J_ShopMoreBtn" title=""
                            style="color: #f57224; border-color: #f57224" href="{{ URL::to('brand') }}">SHOP MORE</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        <!-- Start Single Product -->
                        @if (count($brands) > 0)
                            @foreach ($brands as $brand)
                                <div class="single-product box-shadow mb-10">
                                    <div class="product-img">
                                        <a target="__blank" href="{{ route('brand.slug', ['slug' => $brand->slug]) }}">

                                            @if ($brand->image_link != '')
                                                <img class="default-img"
                                                    src="{{ URL::to('uploads/brand') }}/{{ $brand->image_link }}"
                                                    alt="">
                                            @else
                                                <img class="default-img" src="{{ URL::to('logo/nobrand.png') }}"
                                                    alt="{{ $brand->title }}" style="max-height: 105px">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3><a
                                                href="{{ route('brand.slug', ['slug' => $brand->slug]) }}">{{ $brand->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Start Shop Services Area -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over ৳ 1000</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services Area -->

    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter & <span>Get daily offer updates by email</span></p>

                            <div class="newsletter-inner">

                                <input name="EMAIL" placeholder="Your email address" required="" id="txtemail"
                                    type="email">
                                <button type="button" class="btn" id="subscription">Subscribe</button>
                            </div>

                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Newsletter -->

@endsection
