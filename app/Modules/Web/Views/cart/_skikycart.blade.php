 <?php
    $cart_items = [];
    if(Session::has('cart')){
        $cart_items = Session::get('cart');
    }

    $cart_total = [];
    if(Session::has('cart_total')){
        $cart_total = Session::get('cart_total');
    }
 ?>
 @if(count($cart_items) > 0)
    @foreach($cart_items as $cart)
        <li>
            <div class="tr1">
                <p class="sup" data-opt="+"><i class="fa fa-chevron-up" aria-hidden="true"></i></p>
                <p class="sitemno" product_id="{{$cart['product_id']}}" data-quantity="{{$cart['product_quantity']}}">{{$cart['product_quantity']}}</p>
                <p class="sdown" data-opt="-"><i class="fa fa-chevron-down" aria-hidden="true"></i></p>
            </div>
            <div class="tr2">
                <div class="sitemnoimg">
                    <img src="{{$cart['product_image']}}">
                </div>
                <p class="str2productname">
                    @if(App::getLocale() == 'bn' && !empty($cart['pro_title_bn']))
                        {{$cart['pro_title_bn']}}
                    @else
                        {{$cart['product_title']}}
                    @endif                    
                </p>
            </div>                  
            <div class="tr3">
                <p  class="tr3producttkred">{{__('messages.tk')}} {{number_format($cart['product_quantity'] * $cart['sell_price'], 0)}}</p>
            </div>
            <div class="tr1">
                <p product_id="{{$cart['product_id']}}" class="sitemno remove close-item"><i class="fa fa-times" aria-hidden="true"></i></p>
            </div>
        </li>
    @endforeach
    @else
    <div class="scarditemdetailul123">
        <img src="{{URL::to('frontend/img/bag2.jpg')}}">
        <h3>Your shopping bag is empty. Start shopping now.</h3>
    </div>
 @endif
 