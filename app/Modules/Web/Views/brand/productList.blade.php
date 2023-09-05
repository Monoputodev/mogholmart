@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="{{route('brand.index')}}">Brand <i class="ti-arrow-right"></i></a></li>
						<li>{{$pageTitle}}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<section class="product-area shop-sidebar shop section">
	<div class="container">
		@include('Web::category._filter_form')
		<div class="row">
			<div class="col-12">
				<!-- Shop Top -->
				<div class="shop-top">
					<div class="shop-shorter">
						<div class="single-shorter">
							<h4 class="widget-title"><span style="color: red">{{$total_product}}</span> results for <span style="color: red">{{$brand->title}}</span></h4>
						</div>
					</div>
				</div>
			</div>
			@include('Web::category.shorting')

			@if(isset($product_data) && count($product_data) > 0)
			@foreach($product_data as $product)
			<?php
			if($product->offer_price  > $product->sell_price){
				$percentage = round( ( ( $product->offer_price - $product->sell_price ) / $product->offer_price ) * 100 );
			}else{
				$percentage = 0;
			}
			?>
			<div class="col-md-2 col-6">
                      <div class="single-product box-shadow product-height">
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
								<p class="buyText add_cart_ajax" product_quantity="1" product_weight="{{$product->weight}}" product_id="{{$product->product_id}}" product_category_id="" product_merchant_id="{{$product->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$product->product_id.'/200x200/'.$product->image)}}">Add to bag</p>
							</section>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@endif

			


			<div class="clearfix filters-container">
				<div class="text-right">

					@if(count($product) > 0)

					{{$product_data->links()}}

					@endif


				</div>

			</div>
		</div>

	</div>
</section>


@endsection