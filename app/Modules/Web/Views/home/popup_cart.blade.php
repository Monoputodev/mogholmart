<?php
    if(Session::has('cart')){
        $cart_item_count = count(Session::get('cart'));
        $cart_total = Session::get('cart_total')['total'];
    }else{
        $cart_item_count = 0;
        $cart_total = 0;
    }
?>

<div class="scarditem">
    <div class="scarditemtop">
        <img src="{{URL::to('frontend/img')}}/bag.png">
        <p><span class="total_cart_1">{{$cart_item_count}}</span> ITEMS</p>
    </div>
    <div class="scarditembot">
        <p>{{__('messages.tk')}} <span id="total_price">{{number_format($cart_total, 0)}}</span></p>
    </div>
</div>
<div class="scarditemdetail">
    <div class="scarditemdetail-head">
        <div class="shed1">
            <div class="shed1img">
                <img src="{{URL::to('frontend/img')}}/bag.png">
            </div>
            <p><span class="total_cart_1">{{$cart_item_count}}</span> ITEMS</p>
        </div>
        <div class="shed2">
            <button type="submit" class="shed2batton" name="Close" value="">Close</button>
        </div>
    </div>

    <ul class="scarditemdetailul cart-scroll" id="cart_summary_ajax3">
        @include('Web::cart._skikycart')
    </ul>
    <div class="shooppingfooter">
        <div class="shoppingtCartActionButtons">
            <a class="btn" id="placeOrderButton" href="{{route('web.cart.checkout')}}">
                <span class="placeOrderText">Place Order</span>
                <span class="totalMoneyCount">
                    <span>{{__('messages.tk')}}  </span>
                    <span id="total_price_3">{{number_format($cart_total, 0)}}</span>
                    <span> </span>
                </span>
            </a>
        </div>
    </div>
</div>