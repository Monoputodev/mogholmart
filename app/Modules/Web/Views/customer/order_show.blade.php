@extends('Web::layouts.master')

@section('body')
<div class="breadcrumbs">
<div class="container">
<div class="row">
<div class="col-12">
<div class="bread-inner">
<ul class="bread-list">
<li><a href="{{URL::to('/')}}">Home<i class="ti-arrow-right"></i></a></li>
<li><a href="{{route('web.customer.account')}}">Account <i class="ti-arrow-right"></i></a></li>
<li><a href="#">Order Show</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="contact-us section">
<div class="container">
<div class="row">
<div id="content" class="col-md-9 form-main">

<fieldset>
<legend>Order Details 
<a href="javascript:history.back()" class="btn btn-warning btn-sm pull-right m-r-10 btn-radious">Back</a></legend>
</fieldset>
<div class="row">
<div class="col-sm-12">
<div class="well">
<div class="row">
<div class="col-sm-6">
<h6>
	Invoice Number :: {{$data->order_number}}<br/>
	Date :: {{ date('M d, Y',strtotime($data->date)) }}
</h6>
</div>
<div class="col-sm-6">
<h6>
	Status :: {{ucfirst($data->status)}}				                    	
</h6>
<a style="font-size: 20px;" href="#" class="print_the_pages btn-link">
	Print Invoice
</a>
@if ($data->status == 'delivered' || $data->status == 'shipped')

<a  data-toggle="modal" href="#open_modal" class="btn btn-danger btn-sm font-10 pull-right"><i class="fa fa-undo" aria-hidden="true"></i>
	<span>Return & Refund</span></a>
	@endif
</div>
</div>
</div>
</div>

<div class="col-sm-12">
<div class="well">
<div class="row so-onepagecheckout">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="checkout-content checkout-register">
		<fieldset id="account">
			<h2 class="secondary-title"><i class="fa fa-user-plus"></i>Billing Address</h2>
			<div class="payment-new box-inner">
				@if(count($data->relOrderShipping) > 0)
				@foreach($data->relOrderShipping as $shipping)
				@if($shipping->type == 'billing')
				<table class="table table-responsive"  style="margin-bottom: 7px;border-radius: 2px;">
					<tbody>
						<tr>
							<td>
								<label class="form-check-label radio2" for="" style="width: 100% !important">
									<span class="label2"></span>
									<span class="row">
										Name: {{$shipping->first_name}}<br>	
										Phone: {{$shipping->phone}}<br>
										City: {{$shipping->city}}<br>
										Area: {{$shipping->area}}<br>
										Post Code: {{$shipping->post_code}}<br>
										Address: {{$shipping->address}}<br>
										Special Instruction: {{$shipping->special_instruction}}<br>
									</span>
								</label>
							</td>
						</tr>
					</tbody>
				</table> 
				@endif
				@endforeach
				@endif
			</div>
		</fieldset>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="checkout-content checkout-register">
		<fieldset id="shipping-address">
			<h2 class="secondary-title"><i class="fa fa-map-marker"></i>Shipping Address</h2>
			<div class="checkout-shipping-form">
				<div class="box-inner">

					@if(count($data->relOrderShipping) > 0)
					@foreach($data->relOrderShipping as $shipping)
					@if($shipping->type == 'shipping')
					<table class="table table-responsive"  style="margin-bottom: 7px;border-radius: 2px;">
						<tbody>
							<tr>
								<td>
									<label class="form-check-label radio2" for="" style="width: 100% !important">
										<span class="label2"></span>
										<span class="row">
											Name: {{$shipping->first_name}}<br>	
											Phone: {{$shipping->phone}}<br>
											City: {{$shipping->city}}<br>
											Area: {{$shipping->area}}<br>
											Post Code: {{$shipping->post_code}}<br>
											Address: {{$shipping->address}}<br>
											Special Instruction: {{$shipping->special_instruction}}<br>
										</span>
									</label>
								</td>
							</tr>
						</tbody>
					</table> 
					@endif
					@endforeach
					@endif
				</div>
			</div>
		</fieldset>
	</div>
</div>

<div class="col-lg-12">

	<div class="table-responsive">

		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Product</th>
					<th class="text-center">Quantity</th>
					<th class="text-right">Unit Price</th>
					<th class="text-right">Total Price</th>
				</tr>
			</thead>
			<tbody>

				@if(!empty($data->relOrderDetail))
				<?php
				$total_price = 0;
				?>
				@foreach($data->relOrderDetail as $key => $details)
				<tr>
					<th scope="row">{{$key+1}}</th>
					<td>
						{{isset($details->relProduct)?$details->relProduct->product_title:''}}<br/>
						Product code: {{$details->relProduct->item_no}}<br/>{{ $details->color }},{{ $details->size }}

					</td>
					<td class="text-center">{{$details->quantity}}</td>
					<td class="text-right">{{ __('messages.tk') }} {{number_format($details->price, 2)}}</td>
					<td class="text-right">{{ __('messages.tk') }} {{number_format($details->total_price, 2)}}


					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="4" class="text-right"><b>Sub Total</b></td>
					<td class="text-right"><b>{{ __('messages.tk') }} {{number_format($data->sub_total_price, 2)}}</b></td>
				</tr>

				<tr>
					<td colspan="4" class="text-right"><b>Delivery Cost</b></td>
					<td class="text-right"><b>{{ __('messages.tk') }} {{number_format($data->shipping_value, 2)}}</b></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><b>Sub Total</b></td>
					<td class="text-right"><b>{{ __('messages.tk') }} {{number_format($data->sub_total_price+$data->shipping_value, 2)}}</b></td>
				</tr>

				<tr>
					<td colspan="4" class="text-right"><b>Discount</b></td>
					<td class="text-right"><b>{{ __('messages.tk') }} {{number_format($data->coupon_code_value, 2)}}</b></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><b>Grand Total</b></td>
					<td class="text-right"><b>{{ __('messages.tk') }} {{number_format( ($data->sub_total_price+$data->shipping_value) - $data->coupon_code_value, 2)}}</b></td>
				</tr>
				@endif
			</tbody>  
		</table>
	</div>
</div>
</div>
</div>
</div>


</div>
</div>
@include('Web::customer.menu')
</div>
</div>
</div>
</div>


<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
<div class="print_wrap" style="display:none; width:100%;float:left; font-family: 'Open Sans Condensed', sans-serif; ">
<div id="print_verification_letter" class="" style="display: block;">
<table class="table" style="display: table-cell; width: 100%;">
<tr >
<td colspan="1" style="width: 33.33%; padding:0 0;">
<a href="{{URL::to('/')}}"><img style=" width: 200px" src="{{ URL::to('uploads/generel_file') }}/{{ $main_logo->value }}" alt="" /> </a>
</td>
<td colspan="3">
<h1 style="font-size: 20px">Address</h1>
<p>
{{config('global.OFFICE_ADDRESS')}}
</p>
</td>
</tr>
<tr>
<td colspan="2" style="padding-left: 20px; border-top: 1px solid #ebeced;">
<h5>Invoice Number :: {{$data->order_number}}</h5>
</td>
<td colspan="2"><h5>Date :: {{ date('M d, Y',strtotime($data->date)) }}</h5></td>
</tr>
<tr>
<td colspan="2" style="border-top: 1px solid #ebeced;" >
<strong>Billing Address:</strong>
<br/><br/>
<?php
if(isset($data->relOrderShipping)){
foreach($data->relOrderShipping as $bill_data){
if($bill_data->type == 'billing'){

echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
echo 'Email: '.$bill_data->email .'<br/>';
echo "Phone: ".$bill_data->phone .'<br/>';
echo "Address: ".$bill_data->address .'<br/>';

if ($bill_data->city !=null || $bill_data->area !=null) {

echo "City: ".$bill_data->city . ', ';
echo "Area: ".$bill_data->area . ', ';
echo "Post Code: ".$bill_data->post_code . ', ';
}
}
}
}
?>
</td>
<td colspan="2">
<strong>Shipping Address:</strong>
<br/><br/>
<?php
if(isset($data->relOrderShipping)){
foreach($data->relOrderShipping as $bill_data){
if($bill_data->type == 'shipping'){

echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
echo 'Email: '.$bill_data->email .'<br/>';
echo "Phone: ".$bill_data->phone .'<br/>';
echo "Address: ".$bill_data->address .'<br/>';

if ($bill_data->city !=null || $bill_data->area !=null) {

echo "City: ".$bill_data->city . ', ';
echo "Area: ".$bill_data->area . ', ';
echo "Post Code: ".$bill_data->post_code . ', ';
}

}

}
}
?>
</td>
</tr>
<tr >
<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 10px 10px 10px;width:40%;">Name</td>
<td align="center" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px 10px;width:20%;">Price</td>
<td align="center" style="border-bottom: 1px solid #c5c5c5;padding: 10px 10px 10px;width:10%;">QTY</td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 10px 10px 10px;width:30%;">Total Price</td>
</tr> 
<?php
$total_price = 0;
?>
@if(!empty($data->relOrderDetail))
@foreach($data->relOrderDetail as $details)
<tr>
<td style="border-bottom: 1px solid #c5c5c5; padding: 10px 10px;width: 40%;">{{isset($details->relProduct)?$details->relProduct->product_title:''}}
<span style="font-size: 13px;">Product Code: {{$details->relProduct->item_no}} ({{$details->color}},{{$details->size}})</span>
</td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{ __('messages.tk') }} {{number_format($details->price,2)}}</td>
<td align="center" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 10%;">{{$details->quantity}}</td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 30%;">{{ __('messages.tk') }} {{number_format($details->price * $details->quantity,2)}}
</td>
</tr>
<?php
$total_price+=$details->price * $details->quantity;
?>
@endforeach
@endif
<tr>
<td  colspan="2"></td>
<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Sub total</strong></td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{ __('messages.tk') }} {{number_format($total_price,2)}}</strong></td>
</tr>

<tr>
<td  colspan="2"></td>
<td colspan="1" align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">Delivery Cost</td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">{{ __('messages.tk') }} {{number_format($data->shipping_value,2)}}</td>
</tr>
<tr>
<td colspan="2"></td>
<td  align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Total</strong></td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{ __('messages.tk') }} {{number_format($total_price+$data->shipping_value,2)}}</strong></td>
</tr>

<tr>
<td  colspan="2"></td>
<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">Discount</td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">{{ __('messages.tk') }} {{number_format($data->coupon_code_value,2)}}</td>
</tr>
<tr>
<td colspan="2"></td>
<td  align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Total</strong></td>
<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>{{ __('messages.tk') }} {{number_format( ($total_price+$data->shipping_value) - $data->coupon_code_value ,2)}}</strong></td>
</tr>
</table>
<table>
<tr>
<td colspan="0">For return please contact us at {{config('global.EMAIL_NAME')}}. </br> For feedback or any query please call us at {{config('global.MOBILE_NO')}}</td>
</tr>
</table>
</div>
</div> 

<style>
@media print {
}
</style>

<div id="open_modal" class="modal fade" tabindex="" role="dialog" style="display: none;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4>Return & Refund</h4>
</div>
<div class="modal-body">

{!! Form::open(['route' =>'customer.change.order.refund',  'files'=> true, 'id'=>'order_refund', 'class' => 'form-horizontal']) !!}

@include('Web::customer._form')

<input type="hidden" name="order_status" value="{{ $data->status }}">
<input type="hidden" name="order_id" value="{{ $data->id }}">

{!! Form::close() !!}

</div> <!-- / .modal-body -->
</div> <!-- / .modal-content -->
</div> 
</div>



@endsection