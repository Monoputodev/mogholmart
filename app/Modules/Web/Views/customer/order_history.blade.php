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
						<li><a href="#">Order History</a></li>
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
					<legend>Order History 
						<a href="javascript:history.back()" class="btn btn-warning btn-sm pull-right m-r-10 btn-radious">Back</a></legend>
					</fieldset>
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								<div class="row">
									<div class="col-sm-3">
										<div class="list-group">
											<a href="{{ route('customer.order') }}" class="list-group-item <?=Route::currentRouteName()=='customer.order'? 'active-hover-m':'active-hover-g'?>"> Total Order<br/>({{$total_order}})</a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="list-group">
											<a href="{{ route('customer.todays.order') }}" class="list-group-item <?=Route::currentRouteName()=='customer.todays.order'? 'active-hover-m':'active-hover-g'?>">Today's Order<br/> ({{$todays_order}})</a>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="list-group">
											<a href="{{ route('customer.last.fifteendays.order') }}" class="list-group-item <?=Route::currentRouteName()=='customer.last.fifteendays.order'? 'active-hover-m':'active-hover-g'?>">Last 15 Day's Order<br/>({{$last_15_days_order}})</a>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="list-group">
											<a href="{{ route('customer.currnet.month.order') }}" class="list-group-item <?=Route::currentRouteName()=='customer.currnet.month.order'? 'active-hover-m':'active-hover-g'?>">This Month Order<br/>({{$current_month_order}})</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12" style="margin-top: 10px;">
							<div class="well">
								<div class="all-instructors">
									<div class="table table-responsive">
										<table class="table table-hover table-bordered">
											<thead>
												<tr>
													<th>#</th>
													<th>Product</th>
													<th class="text-right">Unit Price</th>
													<th class="text-right">Total Price</th>
													<th class="text-right">Status</th>
													<th class="text-right">Action</th>
												</tr>
											</thead>
											<tbody>
												@if(!empty($order_data))
												@foreach($order_data as $key => $values)
												<?php
												$order_items = $values::getOrderItems($values);
												?>
												<tr>
													<th>{{ ($order_data->currentpage()-1) * $order_data->perpage() + $key + 1 }}</th>
													
													<td>
														@if(count($order_items) > 0)
														@foreach($order_items as $item)

														<strong>{{ $item->product_title }}</strong><br/>
														<p>QTY: {{ $item->quantity }}</p>

														<p>Product code: {{ $item->item_no }} </p>

														<p>Color: {{ $item->color }} </p>
														<p>Size: {{ $item->size }} </p>
														@endforeach	
														@endif

														
														<p>Date: {{ date('M d, Y',strtotime($values->date)) }}</p>
														<p>
															Shipping Charge: {{__('messages.tk')}} {{number_format($values->shipping_value,2)}}
														</p>
														<p>
															Coupon : {{__('messages.tk')}} {{number_format($values->coupon_code_value,2)}}
														</p>

													</td>
													<td>
														{{__('messages.tk')}} {{number_format($values->total_price,2)}}
													</td>
													
													<td>
														{{__('messages.tk')}} {{number_format( ($values->total_price - $values->coupon_code_value) + $values->shipping_value ,2)}}
													</td>

													<td>
														{{ucfirst($values->status)}}
													</td>
													<td>
														<a class="btn btn-info btn-sm" target="__blank" href="{{ route('customer.order.show', $values->id) }}"><i class="fa fa-eye"></i></a>
													</td>
												</tr>
												@endforeach
												@endif

											</tbody>
										</table>
										<div class="col-sm-12 text-right">
											<ul class="pagination">
												@if(count($order_data) > 0)
												{{$order_data->links()}}
												@endif
											</ul>
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

	@endsection