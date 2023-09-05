<div class="product-area most-popular section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card-fs-content-header J_FSHeader" data-count-down-bg-color="#ff6801">
                    <div class="card-fs-content-header-left J_FSHeaderLeft">
                      <div class="card-fs-content-header-left-status pull-left">
                        <div class="fs-status-text" style="color: undefined">Trending Now</div>
                    </div>

                </div>

                <a class="card-fs-content-button J_ShopMoreBtn" title="" style="color: #f57224; border-color: #f57224" href="#">SHOP MORE</a>
            </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="owl-carousel popular-slider">
          <!-- Start Single Product -->
          @if(count($latest_product)>0)
          @foreach($latest_product as $hot_product_data)
          <?php
          if($hot_product_data->offer_price  > $hot_product_data->sell_price){
            $hot_percentage = round( ( ( $hot_product_data->offer_price - $hot_product_data->sell_price ) *100 ) / $hot_product_data->offer_price);
          }else{
            $hot_percentage = 0;
          }
          ?>
          <div class="single-product-owl box-shadow mb-10 product-height">
            <div class="product-img">
              <a target="__blank" href="{{route('product.slug',['slug' => $hot_product_data->product_slug])}}">

                @if($hot_product_data->image !='')
                <img class="default-img" src="{{URL::to('uploads/product/'.$hot_product_data->product_id.'/200x200/'.$hot_product_data->image)}}" alt="">
                @else
                <img class="default-img" src="{{URL::to('logo/nofound.jpg')}}" alt="{{$hot_product_data->product_title}}">
                @endif

                @if($hot_product_data->offer_price)
                <span class="price-dec">{{ $hot_percentage }}% Off</span>
                @endif
              </a>
              <div class="button-head">
                <div class="product-action">
                  {{-- <a class="product_quick_view" data-href="{{route('product.quick.view')}}" product-id="{{$hot_product_data->product_id}}"  title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> --}}

                  @if(!empty(\Auth::user()))
                  <a  class="add_to_wishlist" data-href="{{route('customer.add.to.wishlist')}}" product-id="{{$hot_product_data->product_id}}" title="Wishlist"> <i class="ti-heart"></i><span>Add to Wishlist</span> </a>

                  @else
                  <a  class="add-to-cart" href="{{route('web.customer.account')}}" target="__blank" title="Wishlist"> <i class="ti-heart"></i><span>Add to Wishlist</span> </a>
                  @endif

                </div>
                <div class="product-action-2">
                  <a title="Add to cart" class="add_cart_ajax" product_quantity="1" product_weight="{{$hot_product_data->weight}}" product_id="{{$hot_product_data->product_id}}" product_category_id="" product_merchant_id="{{$hot_product_data->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$hot_product_data->product_id.'/200x200/'.$hot_product_data->image)}}">Add to cart</a>
                </div>
              </div>
            </div>
            <div class="product-content">
              <h3><a href="{{route('product.slug',['slug' => $hot_product_data->product_slug])}}">{{ $hot_product_data->product_title }}</a></h3>
              <div class="product-price">


                <span>{{__('messages.tk')}} {{ number_format($hot_product_data->sell_price,0)}}</span>

                 @if($hot_product_data->offer_price)
                <span class="old">{{__('messages.tk')}} {{ number_format($hot_product_data->offer_price,0) }}</span>
                @endif
                <section class="addButtonWrapper border-radius-small">
                                <i class="express ti-bag" id="svgIcon"></i>
                    @if($hot_product_data->quantity > 0 || $hot_product_data->quantity == null)
                        <p id="cart" class="buyText add_cart_ajax" product_quantity="1" product_weight="{{$product_data->weight}}" product_id="{{$product_data->product_id}}" product_category_id="" product_merchant_id="{{$product_data->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$product_data->product_id.'/200x200/'.$product_data->image)}}">Add to bag</p>
                    @else
                        <p class="buyText" id="cart-out"><a href="{{route('product.slug',['slug' => $hot_product_data->product_slug])}}">Out of stock</a></p>
                    @endif
                </section>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          <!-- End Single Product -->

        </div>
      </div>
    </div>
  </div>
</div>
