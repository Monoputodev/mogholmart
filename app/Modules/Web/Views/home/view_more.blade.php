@if (count($products) > 0)
{{-- @foreach ($products as $product_data)

    @if ($product_data->offer_price > $product_data->sell_price)
        {{ $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price) }}
    @else
        {{ $percentage = 0 }}
    @endif
    {{ $last_product_id = $product->product_id}}

    <div class="col-md-2 col-6">
        <div class="single-product box-shadow product-height">
            <div class="product-img">
                <a target="__blank" href="{{ route('product.slug', ['slug' => $product_data->slug]) }}">

                    @if ($product_data->image != '')
                        <img class="default-img"
                            src="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}"
                            alt="">
                    @else
                        <img class="default-img" src="{{ URL::to('logo/nofound.jpg') }}"
                            alt="{{ $product_data->product_title }}">
                    @endif

                    @if ($product_data->offer_price)
                        <span class="price-dec">{{ $percentage }}% Off</span>
                    @endif
                </a>
                <div class="button-head">
                    <div class="product-action">


                        @if (!empty(\Auth::user()))
                            <a class="add_to_wishlist" data-href="{{ route('customer.add.to.wishlist') }}"
                                product-id="{{ $product_data->product_id }}" title="Wishlist"> <i
                                    class="ti-heart"></i><span>Add to Wishlist</span> </a>
                        @else
                            <a class="add-to-cart" href="{{ route('web.customer.account') }}" target="__blank"
                                title="Wishlist"> <i class="ti-heart"></i><span>Add to Wishlist</span> </a>
                        @endif

                    </div>
                    <div class="product-action-2">
                        <a title="Add to cart" class="add_cart_ajax" product_quantity="1"
                            product_weight="{{ $product_data->weight }}"
                            product_id="{{ $product_data->product_id }}" product_category_id=""
                            product_merchant_id="{{ $product_data->product_merchant_id }}"
                            product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}">Add
                            to cart</a>
                    </div>
                </div>
            </div>
            <div class="product-content">
                <h3><a
                        href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">{{ $product_data->product_title }}</a>
                </h3>
                <div class="product-price">
                    @if ($product_data->offer_price)
                        <span class="old">{{ __('messages.tk') }}
                            {{ number_format($product_data->offer_price, 0) }}</span>
                    @endif

                    <span>{{ __('messages.tk') }} {{ number_format($product_data->sell_price, 0) }}</span>
                    <section class="addButtonWrapper border-radius-small">
                        <i class="express ti-bag" id="svgIcon"></i>

                        @if ($product_data->quantity > 0 || $product_data->quantity == null)
                            <p class="buyText add_cart_ajax" product_quantity="1" id="cart"
                                product_weight="{{ $product_data->weight }}"
                                product_id="{{ $product_data->product_id }}" product_category_id=""
                                product_merchant_id="{{ $product_data->product_merchant_id }}"
                                product_image="{{ URL::to('uploads/product/' . $product_data->product_id . '/200x200/' . $product_data->image) }}">
                                Add to bag</p>
                        @else
                            <p class="buyText" id="cart-out"><a
                                    href="{{ route('product.slug', ['slug' => $product_data->product_slug]) }}">Out
                                    of stock</a></p>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
@endforeach

--}}
@foreach ($products as $product_data)
<?php
if ($product_data->offer_price > $product_data->sell_price) {
    $percentage = round((($product_data->offer_price - $product_data->sell_price) * 100) / $product_data->offer_price);
} else {
    $percentage = 0;
}
?>
<div class="col-md-4 col-sm-6 col-6 my-3">
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
@endif
@if (isset($new_product_data[0]))
<div class="show_more_product" id="show_more_div">
    <input type="hidden" name="" id="hidden_number_of_product_show" value="4+{{ $skip }}">
    <div class="infinite-scrolling-homepage .wow.animated col-md-12" style="margin-top: 50px;">
        <a href="javascript:void(0)" id="btn-more" data-id="{{ $last_product_id }}">Show more</a>
    </div>
</div>
@endif
</div>
