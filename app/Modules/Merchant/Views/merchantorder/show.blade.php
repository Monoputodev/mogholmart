@extends('Merchant::merchant.merchant_master')
@section('body')

<section class="top-teacher-area section-padding-50" style="background-image: url(img/core-img/texture.png);">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-heading">
					<h3>ORDER DETAILS</h3>
					<h3>{{$varifaid_user->shop_name }}</h3>
					<a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">

				<div class="clever-description">
					<div class="all-instructors mb-30">
						<div class="row">
							<div class="col-6">
								<h4>
									Invoice Number :: {{$orderdata->order_number}}<br/>
									Date :: {{ date('M d, Y',strtotime($orderdata->date)) }}
								</h4>
							</div>							                        

							<div class="col-6">
								<h4>
									Status :: {{ucfirst($orderdata->status)}}				                    	
								</h4>
								<a href="#" class="print_the_pages" style="font-size: 14px; color: blue">
									Print Invoice
								</a>
								
							</div>			
						</div>				                        
						
					</div>
				</div>

				<div class="clever-description">
					<div class="all-instructors mb-30">

						<div class="row">
							<div class="col-6">
								<h4>Billing Address</h4>		                   
								<div class="profile-details" >	                        
									<?php

									if(isset($orderdata->relOrderShipping)){
										foreach($orderdata->relOrderShipping as $bill_data){
											if($bill_data->type == 'billing'){

												echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
												echo $bill_data->address . '<br/>';
												echo "Email: ".$bill_data->email . '<br/>';
												echo "Phone: ".$bill_data->phone . ', ';
											}

										}
									}
									?>
								</div>	
							</div>
							<div class="col-6">
								<h4>Delivery Address</h4>		                   
								<div class="profile-details" >	                        
									<?php

									if(isset($orderdata->relOrderShipping)){
										foreach($orderdata->relOrderShipping as $bill_data){
											if($bill_data->type == 'shipping'){

												echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
												echo $bill_data->address . '<br/>';
												echo "Email: ".$bill_data->email . '<br/>';
												echo "Phone: ".$bill_data->phone . ', ';
											}

										}
									}
									?>
								</div>	
							</div>
						</div>
						
						
					</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">

				<div class="table-responsive">

					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Product</th>
								<th scope="col" class="text-center">Quantity</th>
								<th scope="col" class="text-right">Price</th>
								<th scope="col" class="text-right">Total Price</th>
							</tr>
						</thead>
						<tbody>

							@if(!empty($orderdata->relOrderDetail))
							<?php
							$total_price = 0;
							?>
							@foreach($orderdata->relOrderDetail as $key => $details)
							<tr>
								<th scope="row">{{$key+1}}</th>
								<td>
									{{isset($details->relProduct)?$details->relProduct->product_title:''}}<br/>
									<span style="font-size: 13px;">Product Code: <?php
									$item_no_explode = explode('-',$details->relProduct->item_no);

									if(isset($item_no_explode)){
										


										for($i=2;$i<(count($item_no_explode) - 1);$i++){
											echo $item_no_explode[$i];

											if($i < (count($item_no_explode) - 2)){
												echo '-';
											}
										}
									}

									?></span>
								</td>
								<td class="text-center">{{$details->quantity}}</td>
								<td class="text-right">{{__('messages.tk')}} {{number_format($details->price, 2)}}</td>
								<td class="text-right"> {{__('messages.tk')}} {{number_format($details->total_price, 2)}}

									<?php
									$total_price+=$details->total_price;
									?>
									
								</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="4" class="text-right"><b>Sub Total</b></td>
								<td class="text-right"><b> {{__('messages.tk')}} {{number_format($total_price, 2)}}</b></td>
							</tr>

							<tr>
								<td colspan="4" class="text-right"><b>Delivery Cost</b></td>
								<td class="text-right"><b>{{__('messages.tk')}} {{number_format($orderdata->shipping_value, 2)}}</b></td>
							</tr>
							<tr>
								<td colspan="4" class="text-right"><b>Sub Total</b></td>
								<td class="text-right"><b>{{__('messages.tk')}} {{number_format($total_price+$orderdata->shipping_value, 2)}}</b></td>
							</tr>

							<tr>
								<td colspan="4" class="text-right"><b>Discount</b></td>
								<td class="text-right"><b>{{__('messages.tk')}} {{number_format($orderdata->coupon_code_value, 2)}}</b></td>
							</tr>
							<tr>
								<td colspan="4" class="text-right"><b>Grand Total</b></td>
								<td class="text-right"><b>{{__('messages.tk')}} {{number_format( ($total_price+$orderdata->shipping_value) - $orderdata->coupon_code_value, 2)}}</b></td>
							</tr>
							@endif

						</tbody>  
					</table>

				</div>

			</div>
		</div>


	</div>
</section>    


<div class="print_wrap" style="display:none; width:100%;float:left; font-family: 'Open Sans Condensed', sans-serif; ">
	<div id="print_verification_letter" class="" style="display: block;  ">

		<table class="table" style="display: table-cell; width: 100%;   ">

			<tbody><tr>
				<td colspan="2" style="width: 33.33%; padding:0 0;    ">
					<a href="http://zinismart.com.bd"><img src="http://zinismart.com.bd/logo/zinismart.png" style="height: 50px;" alt="img"></a>
				</td>
				<td colspan="1" style="width: 33.33%;"></td>

				<td colspan="2" align=" " style="width: 33.33%">
					<h1 style="font-size: 20px"> CompanyAddress</h1>
					<p>
						House 3, Flat 5B, Road 35, Sector 7,
						Uttara, Dhaka-1230
						Bangladesh.

					</p>
				</td>
			</tr>

			<tr>
				<td colspan="3" style="padding: 10px; border-top: 1px solid #ebeced;">
					<h4>Invoice Number :: {{$orderdata->order_number}}</h4>
					<h4>Date :: {{ date('M d, Y',strtotime($orderdata->date)) }}</h4>
				</td>
				<td></td>
			</tr>

			<tr>

				<td colspan="" style="width: 33.33%; padding: 10px; border-top: 1px solid #ebeced;">

					<strong>Billing Address:</strong>
					<br><br>
					<?php
					if(isset($orderdata->relOrderShipping)){
						foreach($orderdata->relOrderShipping as $bill_data){
							if($bill_data->type == 'billing'){

								echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
								echo $bill_data->address . '<br/>';
								echo 'Email: '.$bill_data->email .'<br/>';
								echo "Phone: ".$bill_data->phone;

							}

						}
					}
					?>
				</td>
				<td colspan="2" style="width: 33.33%;"></td>

				<td colspan="" style="width: 33.33%; padding: 10px;">

					<strong>Shipping Address:</strong>
					<br><br>
					<?php
					if(isset($orderdata->relOrderShipping)){
						foreach($orderdata->relOrderShipping as $bill_data){
							if($bill_data->type == 'shipping'){

								echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
								echo $bill_data->address . '<br/>';
								echo 'Email: '.$bill_data->email .'<br/>';
								echo "Phone: ".$bill_data->phone;

							}

						}
					}
					?>
				</td>

			</tr>


			<tr>
				<td style="border-bottom: 1px solid #c5c5c5; padding: 10px; margin: 50px;width:40%;font-weight: bold;">Name</td>
				<td align="center" style="border-bottom: 1px solid #c5c5c5; padding:10px;width:20%;text-align: right;font-weight: bold;">Product Price</td>
				<td align="center" style="border-bottom: 1px solid #c5c5c5;padding: 10px;width:20%;font-weight: bold;">Quantity</td>
				<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 10px;width:20%;font-weight: bold;">Total Price</td>
			</tr> 
			

			<?php
			$total_price = 0;
			?>
			@if(!empty($orderdata->relOrderDetail))

			@foreach($orderdata->relOrderDetail as $details)
			<tr>
				<td colspan="1" style="border-bottom: 1px solid #c5c5c5; padding: 10px 10px; margin: 50px;width: 40%;">{{isset($details->relProduct)?$details->relProduct->product_title:''}} <br>
					<span style="font-size: 13px;">Product Code: <?php
					$item_no_explode = explode('-',$details->relProduct->item_no);

					if(isset($item_no_explode)){
						


						for($i=2;$i<(count($item_no_explode) - 1);$i++){
							echo $item_no_explode[$i];

							if($i < (count($item_no_explode) - 2)){
								echo '-';
							}
						}
					}

					?></span></td>
					<td colspan="1" align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{__('messages.tk')}} {{number_format($details->price,2)}}</td>
					<td colspan="1" align="center" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{$details->quantity}}</td>
					<td colspan="1" align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{__('messages.tk')}} {{number_format($details->price * $details->quantity,2)}}</td>
				</tr>

				<?php
				$total_price+=$details->price * $details->quantity;
				?>

				@endforeach

				@endif
				
				
				<tr>
					<td colspan="2"></td>
					<td colspan="" align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Sub total</strong></td>
					<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{__('messages.tk')}} {{number_format($total_price,2)}}</strong></td>
				</tr>

				<tr>
					<td colspan="2"></td>
					<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;font-weight: bold;">Delivery Cost</td>
					<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;font-weight: bold;">{{__('messages.tk')}} {{number_format($orderdata->shipping_value,2)}}</td>
				</tr>
				<tr><td colspan="2"></td>
					<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Total</strong></td>
					<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{__('messages.tk')}} {{number_format($total_price+$orderdata->shipping_value,2)}}</strong></td>
				</tr>

				<tr>
					<td colspan="2"></td>
					<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;font-weight: bold;">Discount</td>
					<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;font-weight: bold;">{{__('messages.tk')}} {{number_format($orderdata->coupon_code_value,2)}}</td>
				</tr>
				<tr><td colspan="2"></td>
					<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Total</strong></td>
					<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{__('messages.tk')}} {{number_format( ($total_price+$orderdata->shipping_value) - $orderdata->coupon_code_value,2)}}</strong></td>
				</tr>
			</tbody>
		</table>

	</div>
</div> 

<style>

@media print {

}

</style>


@endsection