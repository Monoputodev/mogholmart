@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Order Search
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>
	

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body">
				{!! Form::open(['method' =>'GET', 'route' => 'admin.order.search']) !!}
				<?php
				$date_range = [
					'all' => 'All',
					'last_7' => 'Last 7 days',
					'last_30' => 'Last 30 days',
					'last_60' => 'Last 60 days',
					'custom' => 'Custom Range'
				];

				$order_status =  [
					'' => 'Select Status',
					'pending' => 'Pending',
					'confirmed' => 'Confirmed',
					'processing' => 'Processing',
					'on_transit' => 'On Transit',
					'delivered' => 'Delivered',
					'delivery_failed' => 'Delivered Failed',
					'returned' => 'Returned',
					'cancel' => 'Cancel'
				];
				$payment_status =  [
					
					'cod' => 'Cash On Delivery',
					'online_payment' => 'Online-Payment',
					
				];
				?>
				<div class="input-group">

					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							<label>Order Number:</label>
							{!! Form::text('order_no',@Input::get('order_no')? Input::get('order_no') : Input::old('order_no'),['class' => 'form-control','placeholder'=>'Type order number']) !!}
							
						</div>

					</div>

					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							<label>Merchant:</label>
							{!! Form::Select('merchant_id',$merchant_list,@Input::get('merchant_id')? Input::get('merchant_id') : Input::old('merchant_id'),['id'=>'merchant_id', 'class'=>'form-control ']) !!}
							
						</div>

					</div>
					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							<label>Filter by order status:</label>
							{!! Form::Select('status',$order_status,@Input::get('status')? Input::get('status') : Input::old('status'),['id'=>'status', 'class'=>'form-control ']) !!}
							
						</div>

					</div>

					<div class="col-md-2 col-sm-2" >
						
						<div class="form-line">
							
							<label>Date range:</label>
							{!! Form::Select('date_range',$date_range,@Input::get('date_range')? Input::get('date_range') : Input::old('date_range'),['id'=>'date_range', 'class'=>'form-control ']) !!}


						</div>

					</div>

					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							
							<label>From Date</label>
							{!! Form::text('from_date',@Input::get('from_date')? Input::get('from_date') : Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control', 'placeholder'=>'From']) !!}
						</div>

					</div>

					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							
							<label>To Date</label>
							{!! Form::text('to_date',@Input::get('to_date')? Input::get('to_date') : Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control ','placeholder'=>'To']) !!}
						</div>

					</div>
					<div class="col-md-2 col-sm-2" >
						<div class="form-line">
							<label>Filter by Payment:</label>
							{!! Form::Select('payment_type',$payment_status,@Input::get('payment_type')? Input::get('payment_type') : Input::old('payment_type'),['id'=>'payment_type', 'class'=>'form-control ','placeholder'=>'Select Payment Method']) !!}
							
						</div>

					</div>

					<div class="col-md-2 col-sm-2">
						

						<label>&nbsp;</label><br/>
						{!! Form::submit('Search', array('class'=>'btn btn-w-lg btn-info','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
						

					</div>

				</div>


				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>



<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF SEARCHING ORDER DATA
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">

					<table class="table table-bordered table-striped table-hover  dataTable js-basic-example">

						<thead>
							<tr>
								<th>Serial No</th>
								<th> Order Number </th>
								<th> Date </th>
								
								<th> Price</th>
								<th> Delivery Cost</th>
								<th> Discount</th>
								<th> Total Price</th>
								<th> Status</th>
								<th> Payment Method</th>
								<th> Payment Status</th>
								<th> Action </th>

							</tr>
						</thead>

						<tbody>

							@if(!empty($data))
							@foreach($data as $key => $values)

							<?php
							//$order_items = $values::getOrderItems($values);

						
							?>
							<tr>
								<td>{{$key+1}}</td>
								
								<td><a href="{{ route('admin.order.show', $values->id) }}">{{$values->order_number}}</a></td>
								<td>{{ date('M d, Y',strtotime($values->date)) }}</td>
								

								<td>
									Tk. {{number_format($values->total_price,2)}}
								</td>

								<td>
									Tk. {{number_format($values->shipping_value,2)}}
								</td>

								<td>
									Tk. {{number_format($values->coupon_code_value,2)}}
								</td>

								<td>
									Tk. {{number_format( ($values->total_price + $values->shipping_value) - $values->coupon_code_value,2)}}
								</td>

								<td>
									{{ucfirst($values->status)}}
								</td>
								<td>
									@if ($values->payment_type=="cod")
										Cash On Delivery
										@elseif($values->payment_type=="foster_payment")

										Credit / Debit card
									@endif
								</td>
								<td>
									@if ($values->payment_type=="cod" && $values->status=="delivered")
										<button type="button" class="btn btn-success">Success</button>

										@elseif($values->payment_type=="foster_payment" && $values->status=="pending")

											<button type="button" class="btn btn-danger">Failed</button>

										@elseif($values->payment_type=="foster_payment" && $values->status !="pending")
											
											
											@if (isset($values->relTransection) && ($values->relTransection->order_head_id==$values->id))

												<button type="button" class="btn btn-success">Success</button>

											@else

												<button type="button" class="btn btn-info">Confirmed By Admin (ID :: {{$values->updated_by}})</button>

											@endif
											

										@else

										<button type="button" class="btn btn-warning">Pending</button>

									@endif

								</td>
								<td>
									<a style="margin-bottom: 5px" href="{{ route('admin.order.show', $values->id) }}" class="btn btn-info btn-xs" title="Order Details" >Details</a>
									<a style="margin-bottom: 5px" href="{{ route('admin.order.destroy', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Cancel?')" >
										Cancel
									</a>
								</td>

							</tr>

							@endforeach
							@endif

						</tbody>


					</table>
					
				</div>

			</div>
		</div>

	</div>
</div>



<script type="text/javascript">
	$('#from_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});
	$('#to_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});

	$(document).delegate('#date_range','change',function () {
		var range = $(this).val();
		var date_diff = 0;

		if(range == 'last_7'){
			date_diff = 7;
		}else if(range == 'last_30'){
			date_diff = 30;
		}else if(range == 'last_60'){
			date_diff = 60;
		}

		if(date_diff > 0){
			var today = new Date();
			var priorDate = new Date().setDate(today.getDate()-date_diff);
			var first_date = new Date(priorDate);

			var start_date = first_date.getFullYear()+'-'+(("0" + (first_date.getMonth() + 1)).slice(-2))+'-'+(("0" + first_date.getDate()).slice(-2));
			var end_date = today.getFullYear()+'-'+(("0" + (today.getMonth() + 1)).slice(-2))+'-'+(("0" + today.getDate()).slice(-2));

			$('#from_date').val(start_date);
			$('#to_date').val(end_date);
		}

		if(range == 'custom'){
			$('#from_date').attr('readonly',false);
			$('#to_date').attr('readonly',false);
		}else if(range == 'all'){
			$('#from_date').val('');
			$('#to_date').val('');
		}else{
			$('#from_date').attr('readonly',true);
			$('#to_date').attr('readonly',true);
		}

	})

	$('#date_range').trigger('change');
</script>

<script type="text/javascript">

	$('#data-table-responsive').attr('data-page-length','50');
</script>	
@endsection