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

						<h5>Status :: {{ucfirst($data->status)}}</h5>

						@if ($data->status != 'delivered' && $data->status != 'cancel')
							<a href="#" data-href="{{ route('admin.change.order.status') }}" class="status_change_btn" data-status="{{$data->status}}" data-order="{{ $data->id }}" title="{{$data->status}}">Click here to change status</a> |
						@endif
						<a href="#" class="print_the_pages">
							<i class="fa fa-print" aria-hidden="true"></i>
							<span>Print Invoice</span></a> 

						@if ($data->status == 'confirmed' || $data->status == 'shipped')
							
							<a  data-toggle="modal" href="#open_modal" class="btn btn-info btn-xs font-10 pull-right"><i class="material-icons" aria-hidden="true">undo</i>
							<span>Refund</span></a>

						@endif

						</div>

						<div class="col-md-6">

							<h5>Billing Address</h5>

							<?php

							if(isset($data->relOrderShipping)){
								foreach($data->relOrderShipping as $bill_data){
									if($bill_data->type == 'billing'){

										echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
										echo $bill_data->address . '<br/>';
										echo "Email: ".$bill_data->email . '<br/>';
										echo "Phone: ".$bill_data->phone . '<br/>';
										if ($bill_data->city !=null || $bill_data->area !=null) {
											
											echo "City: ".$bill_data->city . ', ';
											echo "Area: ".$bill_data->area . ', ';
										}
									}

								}
							}
							?>

						</div>
						<div class="col-md-6">
							<h5>Delivery Address</h5>

							<?php

							if(isset($data->relOrderShipping)){
								foreach($data->relOrderShipping as $bill_data){
									if($bill_data->type == 'shipping'){

										echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
										echo $bill_data->address . '<br/>';
										echo "Email: ".$bill_data->email . '<br/>';
										echo "Phone: ".$bill_data->phone . '<br/>';
										if ($bill_data->city !=null || $bill_data->area !=null) {
											
											echo "City: ".$bill_data->city . ', ';
											echo "Area: ".$bill_data->area . ', ';
										}
									}

								}
							}
							?>

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
												<th>Serial No</th>
												<th> Product</th>
												<th> Quantity</th>
												<th align="right"> Price</th>
												<th align="right"> Total Price</th>

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
													{{isset($details->relProduct)?$details->relProduct->product_title:''}}<br>
													{{isset($details->relProduct)?$details->relProduct->product_id:''}}
												</td>
												<td>
													{{$details->quantity}}
												</td>
												<td align="right">
													{{number_format($details->price, 2)}}
												</td>
												<td align="right">
													{{number_format($details->total_price, 2)}}

													<?php
													$total_price+=$details->total_price;
													?>
												</td>
											</tr>
											@endforeach

											<tr>
												<td colspan="4" align="right">
													Sub Total
												</td>
												<td align="right">
													{{number_format($total_price, 2)}}
												</td>
											</tr>
											<tr>
												<td colspan="4" align="right">
													Delivery Cost
												</td>
												<td align="right">
													60.00
												</td>
											</tr>
											<tr>
												<td colspan="4" align="right">
													Grand Total
												</td>
												<td align="right">
													{{number_format($total_price+60, 2)}}
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
		<div id="print_verification_letter" class="" style="display: block;  ">

			<table class="table" style="display: table-cell; width: 100%;   ">

				<tr >
					<td colspan="2" style="width: 33.33%; padding:0 0;    " >
						<img style=" max-height: 100px;" src="{{URL::to('uploads/generel_file')}}/logo.png" alt="" />
					</td>
					<td  colspan="1" style="width: 33.33%;"></td>

					<td colspan="2" align=" " style="width: 33.33%">
						<h1 style="font-size: 20px" > CompanyAddress</h1>
						<p>
							{{config('global.OFFICE_ADDRESS')}}.

						</p>
					</td>
				</tr>

				<tr>
					<td colspan="3" style="padding: 40px 0 0; border-top: 1px solid #ebeced;">
						<h5>Invoice Number :: {{$data->order_number}}</h5>
						<h5>Date :: {{ date('M d, Y',strtotime($data->date)) }}</h5>
					</td>
					<td></td>
				</tr>

				<tr >

					<td colspan=""  style="width: 33.33%; padding: 0px 0 30px; border-top: 1px solid #ebeced;" >

						<strong>Billing Address:</strong>
						<br/><br/>
						<?php
						if(isset($data->relOrderShipping)){
							foreach($data->relOrderShipping as $bill_data){
								if($bill_data->type == 'billing'){

									echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
									echo $bill_data->address . '<br/>';
									echo 'Email: '.$bill_data->email .'<br/>';
									echo "Phone: ".$bill_data->phone.'<br/>';
									if ($bill_data->city !=null || $bill_data->area !=null) {
											
											echo "City: ".$bill_data->city . ', ';
											echo "Area: ".$bill_data->area . ', ';
										}


								}

							}
						}
						?>

					</td>
					<td  colspan="2"  style="width: 33.33%;"></td>

					<td colspan=""  style="width: 33.33%; padding: 0px 0 30px">

						<strong>Shipping Address:</strong>
						<br/><br/>
						<?php
						if(isset($data->relOrderShipping)){
							foreach($data->relOrderShipping as $bill_data){
								if($bill_data->type == 'shipping'){

									echo $bill_data->first_name . ' '.$bill_data->last_name.'<br/>';
									echo $bill_data->address . '<br/>';
									echo 'Email: '.$bill_data->email .'<br/>';
									echo "Phone: ".$bill_data->phone.'<br/>';
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


			   <tr >
			    	<td style="border-bottom: 1px solid #c5c5c5; padding: 30px 10px 10px; margin: 50px;width:40%;">Name</td>
			    	<td align="center" style="border-bottom: 1px solid #c5c5c5; padding:30px 10px 10px;width:20%;text-align: right;">Product Price</td>
			    	<td align="center" style="border-bottom: 1px solid #c5c5c5;padding: 30px 10px 10px;width:20%;">Quantity</td>
			    	<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 30px 10px 10px;width:20%;">Total Price</td>
			    </tr> 



				    <?php
				    $total_price = 0;
				    ?>
				    @if(!empty($data->relOrderDetail))

				    @foreach($data->relOrderDetail as $details)

				    <tr>
				    	<td colspan="1" style="border-bottom: 1px solid #c5c5c5; padding: 10px 10px; margin: 50px;width: 40%;">{{isset($details->relProduct)?$details->relProduct->product_title:''}} <br> {{isset($details->relProduct)?$details->relProduct->item_no:''}} </td>
				    	<td colspan="1" align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">${{number_format($details->price,2)}}</td>
				    	<td colspan="1" align="center" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{$details->quantity}}</td>
				    	<td colspan="1" align="right" style="border-bottom: 1px solid #c5c5c5; padding:10px 10px;width: 20%;">{{number_format($details->price * $details->quantity,2)}}
						<p>Cashback ( Tk. {{ number_format($details->cash_back,2) }})</p>
				    	</td>
				    </tr>

				    <?php
				    $total_price+=$details->price * $details->quantity;
				    ?>

				    @endforeach

				    @endif

				    <tr>
				    	<td  colspan="2"></td>
				    	<td colspan="" align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Sub total</strong></td>
				    	<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>tk{{number_format($total_price,2)}}</strong></td>
				    </tr>

				    <tr>
				    	<td  colspan="2"></td>
				    	<td align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">Delivery Cost</td>
				    	<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;">tk{{number_format(60,2)}}</td>
				    </tr>
				    <tr>
				    	<td colspan="2"></td>
				    	<td  align="left" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>Total</strong></td>
				    	<td align="right" style="border-bottom: 1px solid #c5c5c5; padding: 5px 0;"><strong>tk{{number_format($total_price,2)}}</strong></td>
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
                <h4>Refund</h4>
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


		$(document).delegate('.status_change_btn','click',function(){

			var item = $(this);

			bootbox.confirm({
				message: "Are you sure you want to change this current status",
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
						change_status(item);
					}
				}
			});

			return false;
		})


		function change_status(item){
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



	</script>
	@endsection