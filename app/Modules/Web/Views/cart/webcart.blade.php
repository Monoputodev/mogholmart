@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="bread-inner">
            <ul class="bread-list">
              <li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
              <li class="active"><a href="#">Shopping Cart</a></li>
          </ul>
      </div>
  </div>
</div>
</div>
</div>

<div class="alert alert-success alert-dismissible alert-cartupdate" style="display: none;"><i class="fa fa-check-circle"></i> Success: You have modified your shopping cart!
    <button type="button" class="close" data-dismiss="alert">×</button>
</div>


<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table table-responsive shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th> 
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($cart_items) > 0)
                       @foreach($cart_items as $cart)
                       <tr>
                        <td class="image" data-title="No">
                            <a  href="{{route('product.slug',['slug' => $cart['product_slug']])}}">

                                @if(isset($cart['image_link']))
                                <img src="{{URL::to('uploads/product/'.$cart['product_id'].'/200x200/'.$cart['image_link'])}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}">
                                @else

                                <img src="{{URL::to('logo/nofound.png')}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" style="max-height: 200px;max-width: 200px">

                                @endif
                            </a>
                        </td>
                        <td class="product-des" data-title="Description">
                            <p class="product-name">
                                <a href="{{route('product.slug',['slug' => $cart['product_slug']])}}">{{$cart['product_title']}}</a>
                            </p>
                            <p class="product-des"><span class="product-name">Product Code:<span>{{$cart['product_item_no']}}</span></span>
                            </p>
                        </td>
                        <td class="price" data-title="Price"><span>{{__('messages.tk')}} {{number_format($cart['sell_price'], 2)}} </span></td>

                        <td class="qty" data-title="Qty"><!-- Input Order -->

                            <div class="input-group">
                                <div class="button">
                                    <button type="button" class="btn btn-primary btn-number update_cart" product_id="{{$cart['product_id']}}" data-toggle="tooltip" data-field="quant[1]" data-original-title="Update Item">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>

                                <input type="text" name="qty" value="{{$cart['product_quantity']}}"  data-quantity="{{$cart['product_quantity']}}" data-min="1" data-max="1000" class="input-number product_quantity_field{{$cart['product_id']}}">


                            </div>
                            <!--/ End Input Order -->
                        </td>
                        <td class="total-amount" data-title="Total"><span>{{__('messages.tk')}} {{number_format($cart['subtotal'],2)}}</span></td>

                        <td class="action" data-title="Remove">

                            <a href="#" product_id="{{$cart['product_id']}}" class="delete_cart" ><i class="ti-trash remove-icon"></i></a>

                        </td>
                    </tr>
                    @endforeach

                    @else 
                    <center><img src="{{URL::to('logo/oops.jpg')}}" alt="" class="img img-responsive"></center>
                    <center><strong><h2>No Items Add In Your Cart !</h2></strong></center>
                    <center><div><a href="{{URL::to('/')}}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a></div></center>
                    @endif
                </tbody>
            </table>
            <!--/ End Shopping Summery -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Total Amount -->
            <div class="total-amount">
                <div class="row">
                    <div class="col-lg-8 col-md-5 col-12">

                    </div>
                    <div class="col-lg-4 col-md-7 col-12">
                        @if(count($cart_items) > 0)
                        <div class="right">
                            <ul>
                                <li>Cart Subtotal<span>{{__('messages.tk')}} {{number_format($cart_total['total'],2)}}</span></li>
                                <li>Shipping<span>{{__('messages.tk')}} {{$shipping_charge}}</span></li>

                                <li class="last">You Pay<span>{{__('messages.tk')}} {{number_format($cart_total['total']+$shipping_charge,2)}}</span></li>
                            </ul>
                            <div class="button5">
                                <a href="{{route('web.cart.checkout')}}" class="btn">Checkout</a>
                                <a href="{{ URL::to('/') }}" class="btn">Continue shopping</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--/ End Total Amount -->
        </div>
    </div>
</div>
</div>
<section class="shop-services section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
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
<!-- End Shop Newsletter -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
      <div class="inner-top">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 col-12">
            <!-- Start Newsletter Inner -->
            <div class="inner">
              <h4>Newsletter</h4>
              <p> Subscribe to our newsletter for more update !</p>
              
              <div class="newsletter-inner">

                <input name="EMAIL" placeholder="Your email address" required="" id="txtemail" type="email">
                <button type="button" class="btn" id="subscription">Subscribe</button>
            </div>

        </div>
        <!-- End Newsletter Inner -->
    </div>
</div>
</div>
</div>
</section>
@endsection