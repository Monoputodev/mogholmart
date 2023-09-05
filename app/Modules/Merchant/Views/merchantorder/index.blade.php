@extends('Merchant::merchant.merchant_master')
@section('body')

<section class="top-teacher-area section-padding-50" style="background-image: url({{asset('frontend')}}/img/core-img/texture.png);">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-heading">
					<h2>MARCHANT ORDER LIST</h2>
					<h3>{{$varifaid_user->shop_name}}</h3>
					<a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
				</div>
			</div>
		</div>

		<div class="row">   

			<div class="col-6 col-md-3">
				<a class="single-instructor d-flex align-items-center mb-30 <?=Route::currentRouteName()=='todays.order.list'? 'active-hover-m':'bg-color1'?>" href="{{ route('todays.order.list') }}">
					<span class="instructor-thumb">
						<img src="{{ asset('frontend') }}/img/bg-img/order.png" alt="">
					</span>
					<span class="instructor-info">
						<h5>Today's order<br/>({{$todays_order}})</h5>
					</span>
				</a>
			</div>  

			<div class="col-6 col-md-3">
				<a class="single-instructor d-flex align-items-center mb-30 <?=Route::currentRouteName()=='fifteendays.order.list'? 'active-hover-m':'bg-color2'?>" href="{{ route('fifteendays.order.list') }}">
					<span class="instructor-thumb">
						<img src="{{ asset('frontend') }}/img/bg-img/order.png" alt="">
					</span>
					<span class="instructor-info">
						<h5>Last 15 day's order<br/>({{$last_15_days_order}})</h5>
					</span>
				</a>
			</div>

			<div class="col-6 col-md-3">
				<a class="single-instructor  <?=Route::currentRouteName()=='current.month.order.list'? 'active-hover-m':'bg-color3'?> d-flex align-items-center mb-30" href="{{ route('current.month.order.list') }}">
					<span class="instructor-thumb">
						<img src="{{ asset('frontend') }}/img/bg-img/order.png" alt="">
					</span>
					<span class="instructor-info">
						<h5>This month order<br/>({{$current_month_order}})</h5>
					</span>
				</a>
			</div>  

			<div class="col-6 col-md-3">
				<a class="single-instructor <?=Route::currentRouteName()=='total.order.list'? 'active-hover-m':'bg-color4'?> d-flex align-items-center mb-30" href="{{ route('total.order.list') }}">
					<span class="instructor-thumb">
						<img src="{{ asset('frontend') }}/img/bg-img/order.png" alt="">
					</span>
					<span class="instructor-info">
						<h5>Total order<br/>({{$total_order}})</h5>
					</span>
				</a>
			</div>   

			<div class="col-lg-12">

				<div class="table-responsive">

					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Order No</th>
								<th scope="col">Date</th>
								<th scope="col">Product</th>
								<th scope="col">Billing Address</th>
								<th scope="col">Shipping Address</th>	
								<th scope="col">Price</th>
								<th scope="col">Delivery Cost</th>
								<th scope="col">Discount</th>
								<th scope="col">Total Price</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>

							@if(!empty($orderdata))
							@foreach($orderdata as $key => $values)

							<?php
							$order_items = $values::getOrderItems($values);
							$merchant_id=Auth::guard()->user()->id;
							?>
							<tr>
								<th scope="row">{{$key+1}}</th>
								<td><a href="{{ route('merchant.order.show', $values->id) }}">{{$values->order_number}}</a></td>
								<td>{{ date('M d, Y',strtotime($values->date)) }}</td>
								<td>
									@if(count($order_items) > 0)
									@foreach($order_items as $item)
									@if ($item->product_merchant_id==$merchant_id)
									<strong>{{ $item->product_title }}</strong><br/>
									<small>QTY: {{ $item->quantity }}&nbsp;&nbsp;&nbsp;&nbsp;Item No: 
										<?php
										$item_no_explode = explode('-',$item->item_no);

										if(isset($item_no_explode)){
											


											for($i=2;$i<(count($item_no_explode) - 1);$i++){
												echo $item_no_explode[$i];

												if($i < (count($item_no_explode) - 2)){
													echo '-';
												}
											}
										}

										?>
										
									</small><br/>
									@endif
									@endforeach
									@endif

								</td>
								<td>
									<?php
									if(isset($values->relOrderShipping)){
										foreach($values->relOrderShipping as $bill_data){

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

								<td>
									<?php
									if(isset($values->relOrderShipping)){
										foreach($values->relOrderShipping as $bill_data){

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

								<td>
									{{__('messages.tk')}} {{number_format($values->total_price,2)}}
								</td>
								
								<td>
									{{__('messages.tk')}} {{number_format($values->shipping_value,2)}}
								</td>

								<td>
									{{__('messages.tk')}} {{number_format($values->coupon_code_value,2)}}
								</td>

								<td>
									{{__('messages.tk')}} {{number_format( ($values->total_price + $values->shipping_value) - $values->coupon_code_value,2)}}
								</td>

								<td>
									{{ucfirst($values->status)}}
								</td>
								<td>
									<div class="btn-group" role="group" aria-label="Button group with nested dropdown">                         

										<div class="btn-group" role="group">
											<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Action
											</button>
											<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
												<a class="dropdown-item" href="{{ route('merchant.order.show', $values->id) }}">Details</a>
												<a href="{{ route('merchant.order.destroy', $values->id) }}" class="dropdown-item"  onclick="return confirm('Are you sure to Cancel?')" >
													Cancel
												</a>
											</div>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
							@endif
							
						</tbody>
					</table>

					<nav aria-label="Page navigation" class="float-right">
						<ul class="pagination">
							{{ $orderdata->links() }}
						</ul>
					</nav>
					
				</div>

			</div>        

		</div>

	</div>
</section> 



@endsection