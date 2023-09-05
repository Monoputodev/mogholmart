<?php
	$cart_items = [];
	if(Session::has('cart')){
		$cart_items = Session::get('cart');
	}
	$product_quantity=1;
	$selected_attribute=[];
?>
@if(count($cart_items) > 0)
	@foreach($cart_items as $cart) 
			@if($cart['product_id']==$single_items->product_id)
			<?php  
				$product_quantity=$cart['product_quantity'];
				$product_color=$cart['product_color'];
				$product_size=$cart['product_size'];

				$selected_attribute = array($product_color,$product_size);
			?>
			@endif
	@endforeach
@endif
<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
	<!-- Product Slider -->
	<div class="product-gallery">
		<div class="quickview-slider-active">
			@if(count($single_items) > 0)
			<div class="single-slider">
				<img src="{{URL::to('uploads/product/'.$single_items['product_id'].'/orginal_image/'.$single_items['image'])}}" alt="#">
			</div>
			@endif
		</div>
	</div>
	<!-- End Product slider -->
</div>
<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
	<div class="quickview-content">
		<h2>{{$single_items['product_title']}}</h2>
		<div class="quickview-ratting-review">
			<div class="quickview-ratting-wrap">
				<div class="quickview-ratting">
					<i class="yellow fa fa-star"></i>
					<i class="yellow fa fa-star"></i>
					<i class="yellow fa fa-star"></i>
					<i class="yellow fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<a href="#"> (1 customer review)</a>
			</div>
			<div class="quickview-stock">
				<span><i class="fa fa-check-circle-o"></i> in stock</span>
			</div>
		</div>
		<h3>{{__('messages.tk')}} {{number_format($single_items['sell_price'], 0)}}</h3>
		<div class="quickview-peragraph">
			<p>{{ $single_items['short_description'] }}</p>
		</div>
		<div class="size">
			<div class="row">

				@if(count($attribute_list) > 0)	
				@foreach($attribute_list as $attribute)
				@if($attribute['frontend_title']=='Color' || $attribute['frontend_title']=='Size')

				<div class="col-lg-6 col-12">
					<h5 class="title">{{$attribute['frontend_title']}}</h5>

					@if(count($attribute['attribute-option']) > 0)

					<select class="form-control" name="attribute_{{$attribute['frontend_title']}}" id="attribute_{{$attribute['frontend_title']}}">

						<option value="null">--Select {{$attribute['frontend_title']}}--</option>
						@foreach($attribute['attribute-option'] as $attribute_option)

						<option <?=in_array($attribute_option,$selected_attribute)? "selected" : ''?> value="{{$attribute_option}}">{{$attribute_option}}</option>

						@endforeach
					</select>
					@endif

				</div>
				@endif
				@endforeach
				@endif
			</div>
		</div>
		<div class="quantity">
			<!-- Input Order -->
			<div class="input-group">

				<input type="number" name="quantity" class="input-number soniacountereliment"  data-min="1" data-max="1000" product_id="{{$product_data->product_id}}" data-quantity="{{$product_quantity}}" value="{{$product_quantity}}">

			</div>
			<!--/ End Input Order -->
		</div>
		<div class="add-to-cart">
			<a product_quantity="1" product_weight="{{$single_items->weight}}" product_id="{{$single_items->product_id}}" product_category_id="{{$single_items->category_id}}" product_merchant_id="{{$single_items->product_merchant_id}}" product_image="{{URL::to('uploads/product/'.$single_items->product_id.'/200x200/'.$single_items->image)}}" class="btn product_add_cart_ajax">Add to cart</a>

			@if(!empty(\Auth::user()))
			<a class="btn min add_to_wishlist" data-toggle="tooltip" data-placement="right" title="Save For Later" data-href="{{route('customer.add.to.wishlist')}}" product-id="{{$product_data->product_id}}">
				<i class="ti-heart"></i>
			</a>
			@else

			<a href="{{route('web.customer.account')}}" class="btn min"><i class="ti-heart"></i></a>
			@endif
		</div>

	</div>
</div>

