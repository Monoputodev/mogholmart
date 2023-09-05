 <?php
 $cart_items = [];
 if(Session::has('cart')){
  $cart_items = Session::get('cart');
}


if(Session::has('cart_total')){
  $cart_total = Session::get('cart_total')['total'];
}
?>

@if(count($cart_items) > 0)
<div class="dropdown-cart-header">
  <span><span id="total_items_cart">{{$cart_item_count}}</span> Items</span>
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