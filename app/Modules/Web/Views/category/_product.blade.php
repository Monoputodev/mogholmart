<div class="row">
  <div class="col-12">
  <!-- Shop Top -->
  <div class="shop-top">
    <div class="shop-shorter">
      <div class="single-shorter">
        <h6 class="widget-title"><span style="color: red">{{$total_product}}</span> results for <span style="color: red">{{$category_data->category_title}}</span>  @if(isset($attribute_list))
          @if(count($attribute_list) > 0)
          @foreach($attribute_list as $attribute)

          <?php
          $attr_value = '';
          $attr = str_slug(strtolower($attribute['code_column']));
          if(isset($_GET[$attr]))
          {
            $attr_value = $_GET[$attr];
          }
          ?>

          @if($attr_value !='')
          & {{ strtolower($attribute['frontend_title']) }}:
          <span  @if($attribute['frontend_title']=='Color') style="color:white;background: <?=$attr_value?>" @endif >{{$attr_value}} </span>
          @endif

          @endforeach
          @endif
        @endif </h6>
      </div>
    </div>
  </div>
</div>
  @include('Web::category.shorting')
</div>
<div class="row">
  @if(isset($product_data) && count($product_data) > 0)
  @foreach($product_data as $product)
  <?php
  if($product->offer_price  > $product->sell_price){
    $percentage = round( ( ( $product->offer_price - $product->sell_price )* 100) / $product->offer_price );
  }else{
    $percentage = 0;
  }


  ?>
  <div class="category-product">
    <div class="single-product box-shadow">
      <div class="product-img">
        <a target="__blank" href="{{route('product.slug',['slug' => $product->product_slug])}}">

          @if($product->image !='')
          <img class="default-img" src="{{URL::to('uploads/product/'.$product->product_id.'/200x200/'.$product->image)}}" alt="">
          @else
          <img class="default-img" src="{{URL::to('logo/nofound.jpg')}}" alt="{{$product->product_title}}">
          @endif

          @if($product->offer_price)
          <span class="price-dec">{{ $percentage }}% Off</span>
          @endif
        </a>
        <div class="button-head">
          <div class="product-action">
            {{-- <a class="product_quick_view" data-href="{{route('product.quick.view')}}" product-id="{{$product->product_id}}"  title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> --}}

            @if(!empty(\Auth::user()))
            <a  class="add_to_wishlist" data-href="{{route('customer.add.to.wishlist')}}" product-id="{{$product->product_id}}" title="Wishlist"> <i class="ti-heart"></i><span>Add to Wishlist</span> </a>

            @else
            <a  class="add-to-cart" href="{{route('web.customer.account')}}" target="__blank" title="Wishlist"> <i class="ti-heart"></i><span>Add to Wishlist</span> </a>
            @endif

          </div>
          <div class="product-action-2">
            <a title="Add to cart" class="add_cart_ajax" product_quantity="1" product_weight="{{$product->weight}}" product_id="{{$product->product_id}}" product_category_id="" product_merchant_id="{{$product->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$product->product_id.'/200x200/'.$product->image)}}">Add to cart</a>
          </div>
        </div>
      </div>
      <div class="product-content">
        <h3><a href="{{route('product.slug',['slug' => $product->product_slug])}}">{{ $product->product_title }}</a></h3>
        <div class="product-price">
          @if($product->offer_price)
          <span class="old">{{__('messages.tk')}} {{ number_format($product->offer_price,2) }}</span>
          @endif

          <span>{{__('messages.tk')}} {{ number_format($product->sell_price,2)}}</span>
          <section class="addButtonWrapper border-radius-small">
            <i class="express ti-bag" id="svgIcon"></i>
              @if($product->quantity > 0 || $product->quantity == null)
                  <p id="cart" class="buyText add_cart_ajax" product_quantity="1" product_weight="{{$product->weight}}" product_id="{{$product->product_id}}" product_category_id="" product_merchant_id="{{$product->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$product->product_id.'/200x200/'.$product->image)}}">Add to bag</p>
              @else
                  <p class="buyText" id="cart-out"><a href="{{route('product.slug',['slug' => $product->product_slug])}}">Out of stock</a></p>
              @endif
          </section>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endif

</div>


<div class="clearfix filters-container">
  <div class="text-right">

    @if(count($product) > 0)

    {{$product_data->links()}}

    @endif


  </div>

</div>
<!-- /.filters-container -->

</div>
