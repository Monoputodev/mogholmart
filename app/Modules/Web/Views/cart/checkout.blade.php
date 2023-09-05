@extends('Web::layouts.master')
@section('body')

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="{{route('web.my.cart')}}">Shopping Cart<i class="ti-arrow-right"></i></a></li>
						<li><a href="#">Checkout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="alert alert-success alert-dismissible alert-cartupdate" style="display: none;"><i class="fa fa-check-circle"></i> Success: You have modified your shopping cart!
	<button type="button" class="close" data-dismiss="alert">×</button>
</div>
<div class="alert alert-success alert-dismissible alert-coupon" style="display: none;"><i class="fa fa-check-circle"></i> Success: You have applied coupon code!
	<button type="button" class="close" data-dismiss="alert">×</button>
</div>


<div class="shopping-cart section">
	<div class="container">
		<div class="so-onepagecheckout layout1">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

					@if(!Auth::check() || Auth::user()->type != 'customer')
					<div class="checkout-content checkout-login" style="">
						<fieldset>
							<h2 class="secondary-title"><i class="fa fa-unlock"></i>Returning Customer</h2>
							<?php $url = route('checkout.post.login'); ?>
							{!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "login-formas" ,'id'=>'loginform')) !!}
							<div class="box-inner">
								<div class="form-group">
									{!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control inputfield required email','placeholder'=>'E-Mail', 'required']) !!}
									<span class="errors">
										{!! $errors->first('email') !!}
									</span> 
								</div>
								<div class="form-group">
									{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control inputfield', 'placeholder'=>'Password', 'required' ) ) }}                                         
									<span class="errors">
										{!! $errors->first('password') !!}
									</span>
									<a href="{{ route('customer.resetpassword') }}">Forgotten Password</a>
								</div>
								<div class="form-group">
									<input type="submit" value="Login" id="button-login" data-loading-text="Loading..." class="btn-primary button">
								</div>
							</div>
							{!! Form::close() !!}
						</fieldset>
					</div>	                    
					@endif

					{!! Form::model(isset($billing)?$billing:'', ['method' => 'POST','onsubmit'=>'return validateForm()', 'route'=> ['web.cart.confirm.checkout'],'id'=>'checkout_billing', 'class' => 'needs-validation']) !!}


					@if(!Auth::check() || Auth::user()->type != 'customer')
					<div class="checkout-content login-box">
						<h2 class="secondary-title"><i class="fa fa-user"></i>Create an Account or Login</h2>
						<div class="box-inner row">
							<div class="radio col-md-6">
								<label><input type="radio" name="account" value="register" checked="checked">Register</label>
							</div>
							<div class="radio col-md-6">
								<label><input type="radio" name="account" value="login">Login for checkout.</label>
							</div>
						</div>
					</div>
					@else

					@endif

					<div class="checkout-content checkout-register">
						<fieldset id="account">
							<h2 class="secondary-title"><i class="fa fa-user-plus"></i>Your Personal Details</h2>
							<div class="payment-new box-inner">

								<div class="form-group input-firstname required" style="width: 49%; float: left;">

									{!! Form::text('first_name',Request::old('email'),['id'=>'first_name', 'class' => 'form-control','placeholder'=>'First Name *','required'=>'required']) !!}
									<span class="errors">
										{!! $errors->first('first_name') !!}
									</span>

								</div>
								<div class="form-group input-lastname required" style="width: 49%; float: right;">

									{!! Form::text('last_name',Request::old('email'),['id'=>'last_name', 'class' => 'form-control','placeholder'=>'Last Name *','required'=>'required']) !!}
									<span class="errors">
										{!! $errors->first('last_name') !!}
									</span>
								</div>
								<div class="form-group required" style="width: 49%; float: left;">

									{!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control','placeholder'=>'E-Mail *']) !!}

									<span class="errors">
										{!! $errors->first('email') !!}
									</span>
								</div>
								<div class="form-group required" style="width: 49%; float: right;">

									{!! Form::number('phone',Request::old('phone'),['id'=>'phone', 'class' => 'form-resize form-control inputfield','placeholder '=>'Telephone *', 'required']) !!}

									<span class="errors">
										{!! $errors->first('phone') !!}
									</span>
								</div>
							</div>
						</fieldset>
						@if(!Auth::check() || Auth::user()->type != 'customer')
						<fieldset id="password" style="">
							<h2 class="secondary-title"><i class="fa fa-lock"></i>Your Password</h2>
							<div class="box-inner">
								<div class="form-group required">
									<input type="password" name="new_password" value="" placeholder="Password *" id="new_password" class="form-control">
								</div>
								<div class="form-group required">
									<input type="password" name="confirm_new_password" value="" placeholder="Password Confirm *" id="confirm_new_password" class="form-control">
									<span id='message'></span>
								</div>
							</div>
						</fieldset>

						@endif
						<fieldset id="address">
							<h2 class="secondary-title"><i class="fa fa-map-marker"></i>Your Address</h2>
							<div class="checkout-payment-form">
								<div class="box-inner">

									<div id="payment-new" style="display: block">

										<div class="form-group required">
											{!! Form::textarea('address',Request::old('address'),['id'=>'address','style' => 'resize: none', 'class' => 'form-control','placeholder'=>'Billing Address', 'rows'=>'2' , 'required'=>'required' ]) !!}
											<span class="errors">
												{!! $errors->first('address') !!}
											</span>

										</div>
										<div class="form-group required" style="width: 49%; float: left;" >

											{!! Form::text('city',Request::old('email'),['id'=>'city', 'class' => 'form-control','placeholder'=>'Billing City Name *']) !!}
											<span class="errors">
												{!! $errors->first('city') !!}
											</span>

										</div>
										<div class="form-group required" style="width: 49%; float: right;" >


											{!! Form::text('area',Request::old('email'),['id'=>'area', 'class' => 'form-control','placeholder'=>'Billing Area Name *']) !!}
											<span class="errors">
												{!! $errors->first('area') !!}
											</span>
										</div>
										<div class="form-group required">


											{!! Form::text('post_code',Request::old('email'),['id'=>'post_code', 'class' => 'form-control','placeholder'=>'Billing post code *']) !!}
											<span class="errors">
												{!! $errors->first('post_code') !!}
											</span>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="same_as_avobe" value="same_as_avobe" checked="checked" style="margin-left: 10px;">
								My delivery and billing address are the same.
							</label>
						</div>

						<fieldset id="shipping-address" style="display: none;">
							<h2 class="secondary-title"><i class="fa fa-map-marker"></i>Shipping Address</h2>
							<div class="checkout-shipping-form">
								<div class="box-inner">
									@if(isset($shipping) && count($shipping) > 0 )
									@foreach($shipping as $key => $ship)
									<div class="col-md-6 col-sm-6  col-xs-6 text-left" style="">
										<table class="table table-responsive"  style="margin-bottom: 7px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);border-radius: 2px;">
											<tbody>
												<tr>
													<td>
														<label class="form-check-label radio2" for="shipping_{{$key}}" style="width: 100% !important">
															<input  type="radio" name="shipping_value" id="shipping_{{$key}}" class="fakeRadio" value="{{$ship->id}}" @if($key==0) checked @endif />
															<span class="label2"></span>
															<span class="row">
																Name: {{$ship->first_name}}<br>	
																Phone: {{$ship->phone}}<br>
																City: {{$ship->city}}<br>
																Area: {{$ship->area}}<br>
																Post Code: {{$ship->post_code}}<br>
																Address: {{$ship->address}}
															</span>
														</label>
													</td>

												</tr>
												<tr>
													<td style="text-align: right;">
														<a  href="{{ route('checkout.delete.shipping.billing.address', $ship->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
														<a  data-href="{{ route('customer.edit.shipping.billing.address', $ship->id) }}" class="btn btn-success btn-xs  open-customer-edit-modal" style="cursor: pointer;" title="Edit"><i class="fa fa-edit"></i></a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>	
									@endforeach
									@else
									<div id="shipping-new">

										<div class="form-group input-firstname" style="width: 49%; float: left;">

											{!! Form::text('shipping_first_name',Request::old('email'),['id'=>'shipping_first_name', 'class' => 'form-control','placeholder'=>'First Name *']) !!}
											<span class="errors">
												{!! $errors->first('shipping_first_name') !!}
											</span>
										</div>
										<div class="form-group input-lastname" style="width: 49%; float: right;">
											{!! Form::text('shipping_last_name',Request::old('shipping_last_name'),['id'=>'shipping_last_name', 'class' => 'form-control','placeholder'=>'Last Name *']) !!}
											<span class="errors">
												{!! $errors->first('shipping_last_name') !!}
											</span>
										</div>
										<div class="form-group" style="width: 49%; float: left;">

											{!! Form::email('shipping_email',Request::old('shipping_email'),['id'=>'shipping_email', 'class' => 'form-control','placeholder'=>'E-Mail *']) !!}

											<span class="errors">
												{!! $errors->first('shipping_email') !!}
											</span>
										</div>
										<div class="form-group" style="width: 49%; float: right;">
											{!! Form::text('shipping_phone',Request::old('shipping_phone'),['id'=>'shipping_phone', 'class' => 'form-resize form-control inputfield','placeholder '=>'Telephone *']) !!}

											<span class="errors">
												{!! $errors->first('shipping_phone') !!}
											</span>
										</div>
										<div class="form-group" style="width: 49%; float: left;" >
											{!! Form::text('shipping_city',Request::old('email'),['id'=>'shipping_city', 'class' => 'form-control','placeholder'=>'Shipping City Name *']) !!}
											<span class="errors">
												{!! $errors->first('shipping_city') !!}
											</span>
										</div>
										<div class="form-group" style="width: 49%; float: right;" >
											{!! Form::text('shipping_area',Request::old('email'),['id'=>'shipping_area', 'class' => 'form-control','placeholder'=>'Shipping Area Name *']) !!}
											<span class="errors">
												{!! $errors->first('shipping_area') !!}
											</span>
										</div>
										<div class="form-group required">
											{!! Form::text('shipping_post_code',Request::old('email'),['id'=>'shipping_post_code', 'class' => 'form-control','placeholder'=>'Shipping Post Code *']) !!}
											<span class="errors">
												{!! $errors->first('shipping_post_code') !!}
											</span>
										</div>
										<div class="form-group">
											{!! Form::textarea('shipping_address',Request::old('shipping_address'),['id'=>'shipping_address','style' => 'resize: none', 'class' => 'form-control','placeholder'=>'Shipping Address', 'rows'=>'2' ]) !!}
											<span class="errors">
												{!! $errors->first('shipping_address') !!}
											</span>
										</div>
									</div>
									@endif
								</div>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<section class="section-left">
						<div class="ship-payment">
							<div class="checkout-content checkout-shipping-methods">
								<h2 class="secondary-title"><i class="fa fa-location-arrow"></i>Shipping Method</h2>
								<div class="box-inner">
									<p><strong>Flat Rate</strong></p>
									<div class="radio flat flat flat.flat flat">
										<label>
											<input type="radio" id="gen_delivery_cost" name="gen_delivery_cost" value="{{$shipping_charge}}" checked="checked">
											Flat Shipping Rate - {{__('messages.tk')}} {{number_format($shipping_charge,2)}}

										</label>
									</div>
								</div>
							</div>
							<div class="checkout-content checkout-payment-methods">
								<h2 class="secondary-title"><i class="fa fa-credit-card"></i>Payment Method</h2>
								<div class="box-inner">
									<div class="radio">
										<label>
											<input type="radio" name="payment_method" value="cod" checked="checked">
											Cash On Delivery
										</label>
									</div>
	{{-- <div class="radio">
		<label>
			<input type="radio" name="payment_method" value="online_payment" checked="checked">
			Online Payment
		</label>
	</div> --}}
</div>
</div>
</div>
</section>


<section class="section-right">
	<div id="coupon_voucher_reward">
		<div class="checkout-content coupon-voucher">
			<h2 class="secondary-title"><i class="fa fa-gift"></i>Do you Have a Coupon or Voucher?</h2>
			<div class="box-inner">

				<div class="panel-body checkout-voucher">
					<label class="col-sm-2 control-label" for="input-voucher">Enter voucher code</label>
					<div class="input-group">
						<input type="text" name="coupon_code" value="" placeholder="Enter voucher code" id="coupon_code_id" class="form-control">
						<span class="input-group-btn">
							<input type="button" value="Apply Voucher" id="submit_coupon" data-loading-text="Loading..." class="btn-primary button">
						</span>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="checkout-content checkout-cart">
		<h2 class="secondary-title"><i class="fa fa-shopping-cart"></i>Shopping Cart </h2>
		<div class="box-inner">
			<div class="table-responsive checkout-product">
				@if(count($cart_items) > 0)
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-left name" colspan="2">Product Name</th>
							<th class="text-center quantity">Quantity</th>
							<th class="text-center price">Price</th>
							<th class="text-right total">Total Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart_items as $cart)

						<tr class="cart_item_tr{{$cart['product_id']}}" product_id="{{$cart['product_id']}}">
							<td class="text-left name" colspan="2">
								<a target="__blank" href="{{route('product.slug',['slug' => $cart['product_slug']])}}">
									@if(isset($cart['image_link']))
									<img src="{{URL::to('uploads/product/'.$cart['product_id'].'/50x50/'.$cart['image_link'])}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" class="img-thumbnail checkoutimage">
									@else

									<img src="{{URL::to('logo/nofound.png')}}" alt="{{$cart['product_title']}}" title="{{$cart['product_title']}}" class="img-thumbnail checkoutimage" style="max-height: 47px;max-width: 47px">

									@endif


								</a>
								<a target="__blank" href="{{route('product.slug',['slug' => $cart['product_slug']])}}" class="product-name">{{$cart['product_title']}}</a>
								<br>
								&nbsp;

							</td>
							<td class="text-left quantity">
								<div class="input-group">

									<input type="text" name="qty" value="{{$cart['product_quantity']}}" size="1" product_id="{{$cart['product_id']}}" class="form-control product_quantity_field{{$cart['product_id']}}">

									<span class="input-group-btn">

										<span data-toggle="tooltip" title="" data-product-key="{{$cart['product_id']}}" class="btn-delete delete_cart"  product_id="{{$cart['product_id']}}"  data-original-title="Remove"><i class="fa fa-trash-o"></i></span>

										<span data-toggle="tooltip" title="" data-product-key="{{$cart['product_id']}}" product_id="{{$cart['product_id']}}"class="btn-update update_cart" data-original-title="Update"><i class="fa fa-refresh"></i></span>
									</span>
								</div>
							</td>
							<td class="text-right price"> {{number_format($cart['sell_price'], 0)}}{{__('messages.tk')}}</td>
							<td class="text-right total"> {{number_format($cart['subtotal'],0)}}{{__('messages.tk')}}</td>
						</tr>

						@endforeach

					</tbody>
					@if(count($cart_items) > 0)
					<tfoot>
						<tr>
							<td colspan="4" class="text-left">Sub-Total:</td>
							<td class="text-right"> {{number_format($cart_total['total'],2)}}{{__('messages.tk')}}</td>
						</tr>
						<tr>
							<td colspan="4" class="text-left">Flat Shipping Rate:</td>
							<td class="text-right">{{number_format($shipping_charge,2)}} {{__('messages.tk')}} </td>
						</tr>
						<tr>
							<td colspan="4" class="text-left">Discount:</td>
							<td class="text-right"> &nbsp;<span id="coupon_amount"> 0.00 {{__('messages.tk')}}</span> </td>
						</tr>
						<tr>
							<td colspan="4" class="text-ri">Total:</td>
							<td class="text-right"><span id="total_coupon">{{number_format($cart_total['total']+$shipping_charge,2)}} {{__('messages.tk')}}</span></td>
						</tr>
					</tfoot>
					@endif
				</table>
				@endif

			</div>
			<div id="payment-confirm-button" class="payment-cod">
				<h2 class="secondary-title"><i class="fa fa-credit-card"></i>Payment Details</h2>
				<div class="buttons">
					<div class="pull-right">
						<input type="button" value="Confirm Order" id="button-confirm" data-loading-text="Loading..." class="btn btn-primary">
					</div>
				</div>


			</div>
		</div>
	</div>

	<div class="checkout-content confirm-section">
		<div>
			<h2 class="secondary-title"><i class="fa fa-comment"></i>If Any Instruction About Your Order? Write Here</h2>
			<label>
				<textarea name="special_instruction" id="special_instruction" placeholder="If any special instruction for your order delivery, Please write here." rows="3" class="form-control "></textarea>
			</label>
		</div>

		<div class="checkbox check-newsletter">
			<label for="newsletter">
				<input type="checkbox" checked name="newsletter" value="1" id="newsletter">
				I want to receive exclusive offers and promotions from <b style="color: #ec242c">{{config('app.name')}}</b>.
			</label>
		</div>


		<div class="checkbox check-terms">
			<label title="Read & Click Agree Option For Complete Your Order.">
				<input type="checkbox" name="agree" id="agreeTerms" value="1">
				I have read and agree to the <a href="{{route('web.privacy.ploicy')}}" target="_blank" ><b style="color: #ec242c">{{config('app.name')}} Privacy Policy</b></a>
			</label>
		</div>

		<div class="confirm-order">
			<button id="so-checkout-confirm-button" type="submit" data-loading-text="Loading..." class="btn btn-success button confirm-button" disabled>Place Order</button>
		</div>                            
	</div>

</section>
</div>
</div>
</div>
{!! Form::close() !!}
</div>
</div>

</div>

@endsection