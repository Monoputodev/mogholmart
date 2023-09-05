@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
	<h2 class="pull-left">
		Order details form
	</h2>
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
</div>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					ORDER DETAILS
				</h2>
			</div>
			<div class="body">

				<div class="row">

					<div class="col-md-6">

						<h5>Invoice Number :: {{$data->order_number}}</h5>
						<h5>Date :: {{ date('M d, Y',strtotime($data->date)) }}</h5>
					</div>

					<div class="col-md-6">

						<h5>Status :: {{ucfirst($data->status)}} || Payment Method :: @if ($data->payment_type=="cod")
							Cash On Delivery
							@elseif($data->payment_type=="foster_payment")

							Credit / Debit card
						@endif </h5>

						@if ($data->status != 'returned')

						<a data-toggle="modal" href="#open_modal_change_status">Click here to change status</a>
						|
						@endif
						<a href="#" class="print_the_pages">
							<i class="fa fa-print" aria-hidden="true"></i>
							<span>Print Invoice</span></a> |

							@if ($data->status == 'pending')

							<a data-href="{{ route('admin.change.order.status.cancel') }}" class="status_change_btn_cancel" data-status="{{$data->status}}" data-order="{{ $data->id }}" style="cursor: pointer;" title="{{$data->status}}">Click here to order cancel</a>

							@endif

							@if($data->status == 'processing')
							@if(empty($data->courier_id))
							<a  data-toggle="modal" href="#open_courier_model">
								<span>Go to Deliver</span></a>
								@else
								<span style="color: green;font-weight: 700;">Courier ID:: {{$data->courier_id}}</span>
								@endif
								@endif

								@if ($data->status != 'pending')
								<a  data-toggle="modal" href="#open_modal" class="btn btn-info btn-xs font-10 pull-right"><i class="material-icons" aria-hidden="true">undo</i>
									<span>Returned</span></a>
									@endif
								</div>
								<div class="col-md-6" style="margin-left: 1px;">
									<h5>Billing Address</h5>
									<?php
									if(isset($data->relOrderShipping)){
										foreach($data->relOrderShipping as $bill_data){
											if($bill_data->type == 'billing'){
												echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
												echo "Email: ".$bill_data->email . '<br/>';
												echo "Phone: ".$bill_data->phone . '<br/>';
												echo "Address: ".$bill_data->address . '<br/>';
												echo "Special Instructions: ".$bill_data->special_instruction . '<br/>';

												if ($bill_data->city !=null || $bill_data->area !=null) {

													echo "City: ".$bill_data->city . ', ';
													echo "Area: ".$bill_data->area . ', ';
												}

											}

										}
									}
									?>

								</div>
								<div class="col-md-6" style="margin-right: -10px">
									<h5>Delivery Address</h5>
									<?php
									$reponse="";
									if(isset($data->relOrderShipping)){
										foreach($data->relOrderShipping as $bill_data){
											if($bill_data->type == 'shipping'){
												echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
												echo "Email: ".$bill_data->email . '<br/>';
												echo "Phone: ".$bill_data->phone . '<br/>';
												echo "Address: ".$bill_data->address . '<br/>';
												echo "Special Instructions: ".$bill_data->special_instruction . '<br/>';

												if ($bill_data->city !=null || $bill_data->area !=null) {

													echo "City: ".$bill_data->city . ', ';
													echo "Area: ".$bill_data->area . ', ';echo "Post Code: ".$bill_data->post_code . ', ';
												}
												$reponse=$bill_data->id;
											}

										}
									}
									?>
									<a  data-href="{{ route('order.edit.shipping.billing.address', $reponse) }}" class=" open-order-shipping-edit-modal" style="cursor: pointer; font-weight: 600">Click Here To Change Address</a>

								</div>
							</div>
							<div class="row clearfix">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="card">
										<div class="header">
											<h2>
												LIST OF ORDER DATA
											</h2>
										</div>
										<div class="body">
											<div class="table-responsive">

												<table id="" class="table">

													<thead>
														<tr>
															<th>#</th>
															<th> Merchant</th>
															<th> Product</th>
															<th> Quantity</th>
															<th style="text-align: right;"> Price</th>
															<th style="text-align: right;"> Total Price</th>
														</tr>
													</thead>

													<tbody>

														@if(!empty($data->relOrderDetail))
														<?php
														$total_price = 0;
														?>
														@foreach($data->relOrderDetail as $key => $details)

														<tr>
															<td>{{$key+1}}</td>
															<td>
																Name :: {{isset($details->relMerchant)?$details->relMerchant->shop_name:''}}<br>
																Phone No:: {{isset($details->relMerchant)?$details->relMerchant->first_contact_person_details:''}}
															</td>
															<td>
																{{isset($details->relProduct)?$details->relProduct->product_title:''}}<br>
																Product code :: {{isset($details->relProduct)?$details->relProduct->item_no:''}} ({{$details->color}},{{$details->size}})

															</td>
															<td>
																{{$details->quantity}}
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($details->price, 2)}}
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($details->total_price, 2)}}

																<?php
																$total_price+=$details->total_price;
																?>
																{{-- <p>Cashback ( {{ __('messages.tk') }}. {{ number_format($details->cash_back,2) }})</p> --}}
															</td>
														</tr>
														@endforeach

														<tr>
															<td colspan="5" align="right">
																Sub Total
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($total_price, 2)}}
															</td>
														</tr>
														<tr>
															<td colspan="5" align="right">
																Delivery Cost
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($data->shipping_value, 2)}}
															</td>
														</tr>
														<tr>
															<td colspan="5" align="right">
																Sub Total
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($total_price+$data->shipping_value, 2)}}
															</td>
														</tr>

														<tr>
															<td colspan="5" align="right">
																Discount
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format($data->coupon_code_value, 2)}}
															</td>
														</tr>
														<tr>
															<td colspan="5" align="right">
																Grand Total
															</td>
															<td align="right">
																{{ __('messages.tk') }} {{number_format( ($total_price+$data->shipping_value) - $data->coupon_code_value , 2)}}
															</td>
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
				</div>
			</div>

			<!-- --- Print --- -->
			<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
			<div class="print_wrap" style="display:none; width:100%;float:left; font-family: 'Open Sans Condensed', sans-serif; ">
				<div id="print_verification_letter" class="" style="display: block;">
					<table class="table" style="display: table-cell; width: 100%;">
						<tr >
							<td colspan="1" style="width: 33.33%; padding:0 0;">
								<img style=" max-height: 100px;" src="{{URL::to('uploads/generel_file')}}/logo.png" alt="" /> 
								
							</td>
							<td colspan="3">
								<h1 style="font-size: 20px">Address</h1>
								<p>
									{{config('global.OFFICE_ADDRESS')}}.
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
												echo "Area: ".$bill_data->area . ', ';echo "Post Code: ".$bill_data->post_code . ', ';
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
											}

										}

									}
								}
								?>
							</td>
						</tr>
						<tr>
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
							<td colspan="0">{{url()->current()}} </br> For return please contact us at {{config('global.EMAIL_NAME')}}. </br> For feedback or any query please call us at {{config('global.MOBILE_NO')}}</td>
						</tr>
					</table>
				</div>
			</div>
			<style>
				@media print {

				}
			</style>
			<div id="open_modal_change_status" class="modal fade" tabindex="" role="dialog" style="display: none;">
				<div class="modal-dialog modal-small">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Change Order Status</h4>
						</div>
						<div class="modal-body">
							{!! Form::open(['route' =>'admin.change.order.status',  'files'=> true, 'id'=>'order_status_change', 'class' => 'form-horizontal order_status_change_form']) !!}
							<?php
							use Illuminate\Support\Facades\URL;
							use Request;
							?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">

										<div class="form-line">
											{!! Form::label('order_status', 'Select Order Status', array('class' => 'col-form-label')) !!}<span class="required">*</span> 
											{!! Form::Select('order_status',array('pending'=>'Pending','confirmed'=>'Confirmed','processing' => 'Processing','on_transit' => 'On Transit','delivered' => 'Delivered','delivery_failed' => 'Delivery Failed','returned' => 'Returned','cancel' => 'Cancel'),Request::old('order_status'),['id'=>'order_status', 'class'=>'form-control selectheight']) !!}
											{!! $errors->first('order_status') !!}
										</div>

										<span class="error">{!! $errors->first('note') !!}</span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">

										<div class="col-md-12">
											{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
										</div>
									</div>

								</div>
							</div>
							<input type="hidden" name="order_id" value="{{ $data->id }}">
							<script>
								$(function() {
									$("#order_status_change").validate({
										rules:{

											order_status:{
												required:true
											}
										},
										messages:{
											order_status: 'Plese choose one'
										}
									});
								});
							</script>
							{!! Form::close() !!}
						</div> <!-- / .modal-body -->
					</div> <!-- / .modal-content -->
				</div> 
			</div>

			<div id="open_modal" class="modal fade" tabindex="" role="dialog" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Returned</h4>
						</div>
						<div class="modal-body">

							{!! Form::open(['route' =>'admin.change.order.refund',  'files'=> true, 'id'=>'order_refund', 'class' => 'form-horizontal attribute_option_form']) !!}

							@include('Order::order._form')

							<input type="hidden" name="order_status" value="{{ $data->status }}">
							<input type="hidden" name="order_id" value="{{ $data->id }}">

							{!! Form::close() !!}

						</div> <!-- / .modal-body -->
					</div> <!-- / .modal-content -->
				</div> 
			</div>

			<div id="open_courier_model" class="modal fade" tabindex="" role="dialog" style="display: none;">
				<div class="modal-dialog modal-small">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Go To Deliver</h4>
						</div>
						<div class="modal-body">

							{!! Form::open(['route' =>'admin.select.courier',  'files'=> true, 'id'=>'courier_id', 'class' => 'form-horizontal']) !!}

							@include('Order::order._courier_form')
							<input type="hidden" name="order_head_id" value="{{ $data->id }}">
							{!! Form::close() !!}

						</div> <!-- / .modal-body -->
					</div> <!-- / .modal-content -->
				</div> 
			</div>

			<div class="modal fade open_modal_update" tabindex="" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Update Shipping Info</h4>

						</div>
						<div class="modal-body">



						</div> <!-- / .modal-body -->
					</div> <!-- / .modal-content -->
				</div> 
			</div>

			<script type="text/javascript">

				$(document).delegate('.print_the_pages','click',function(){
					PrintDiv();
					return false;
				});        

				function PrintDiv() {		
					var restorepage = $('body').html();
					var printcontent = $('#print_verification_letter').clone();
					$('body').empty().html(printcontent);
					window.print();
					$('body').html(restorepage)
				}

				$(document).delegate('.status_change_btn_cancel','click',function(){
					var item = $(this);
					bootbox.confirm({
						message: "Are you sure you want to cancel this order ??",
						buttons: {
							confirm: {
								label: 'Yes',
								className: 'btn-success'
							},
							cancel: {
								label: 'No',
								className: 'btn-danger'
							}
						},
						callback: function (result) {
							if(result){
								cancel_order(item);
							}
						}
					});

					return false;
				})

				function cancel_order(item){
					var url = $(item).attr('data-href');
					var status = $(item).attr('data-status');
					var id = $(item).attr('data-order');

					$.ajax({
						url: url,
						method: "POST",
						data: {_token: '{!! csrf_token() !!}', order_status:status, order_id: id},
						dataType: "json",
						beforeSend: function( xhr ) {
							$('.loader_wrap').addClass('active');
						},
						async: true,
					}).done(function( data ) {
						$('.loader_wrap').removeClass('active');
						location.reload();

					}).fail(function( jqXHR, textStatus ) {
						location.reload();
					});

					return true;
				}

				$(document).delegate('.open-order-shipping-edit-modal','click',function () {
					var url = $(this).attr('data-href');
					var id = '';
					$.ajax({
						url: url,
						method: "GET",
						data: {id:id},
						dataType: "json",
						beforeSend: function( xhr ) {
						}
					}).done(function( response ) {
						if(response.result == 'success'){
							$('.open_modal_update .modal-body').html(response.content);

							$('.open_modal_update').modal('show');

						}else{
						}
					}).fail(function( jqXHR, textStatus ) {

					});
					return false;
				});

			</script>
			@endsection