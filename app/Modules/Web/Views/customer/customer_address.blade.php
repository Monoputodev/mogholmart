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
						<li><a href="#">Address Book</a></li>
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
					<legend>Billing/Shipping Address      
						<button data-toggle="modal" data-target="#edit_profile" class="btn btn-success btn-sm pull-right m-r-10 btn-radious"><i class="fa fa-plus"></i> Add New Address</button>

						<a href="javascript:history.back()" class="btn btn-warning btn-sm pull-right m-r-10 btn-radious">Back</a>

					</legend>


				</fieldset>
				<div class="row">
					<div class="col-sm-6 box-shadow">
						<div class="well">
							<div class="all-instructors mb-30">
								<h4>Billing Address</h4>
								@if (!empty($billing_address))

								<div class="profile-details" >                          

									<b>Name</b> : {{$billing_address->first_name}} {{$billing_address->last_name}}
									<br/>
									<b>Email</b> : {{$billing_address->email}}
									<br/>
									<b>Phone</b> : {{$billing_address->phone}}
									<br/>
									<b>Alternative Phone</b> : {{$billing_address->alternative_phone}}
									<br/>
									<b>Address</b> : {{$billing_address->address}}
									<br/>
									<b>Special instruction </b> : {{$billing_address->special_instruction}}
									<br/>
									<b>Area</b> : {{$billing_address->city}}, {{$billing_address->area}},{{$billing_address->post_code}}

									<a  href="{{ route('customer.delete.shipping.billing.address', $billing_address->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm pull-right "><i class="fa fa-trash"></i></a>
									<a  data-href="{{ route('customer.edit.shipping.billing.address', $billing_address->id) }}" class="btn btn-success btn-sm pull-right m-r-10 btn-radious  btn-custome open-customer-edit-modal"><i class="fa fa-edit"></i></a>
								</div>                                        
								@endif

							</div>
						</div>
					</div>
					@if(isset($shipping_address) && count($shipping_address)>0)
					<?php $x=0 ?>
					@foreach ($shipping_address as $sa)
					<?php $x++ ?>
					<div class="col-sm-6 box-shadow">
						<div class="well">
							<div class="all-instructors mb-30">
								<h4>Shipping Address: {{$x}}</h4>

								<div class="profile-details">

									<b>Name</b> : {{$sa->first_name}} {{$sa->last_name}}
									<br/>
									<b>Email</b> : {{$sa->email}}
									<br/>
									<b>Phone</b> : {{$sa->phone}}
									<br/>
									<b>Alternative Phone</b> : {{$sa->alternative_phone}}
									<br/>
									<b>Address</b> : {{$sa->address}}
									<br/>
									<b>Special Instruction</b> : {{$sa->special_instruction}}
									<br/>

									<b>Area</b> : {{$sa->city}}, {{$sa->area}} , {{$sa->post_code}} 

									<a  href="{{ route('customer.delete.shipping.billing.address', $sa->id) }}" onclick="return confirm('Are you sure to Delete?')" class="btn btn-danger btn-sm pull-right"><i class="fa fa-trash"></i>
									</a>
									<a data-href="{{ route('customer.edit.shipping.billing.address', $sa->id) }}" class="btn btn-success btn-custome btn-sm pull-right m-r-10 open-customer-edit-modal"><i class="fa fa-edit"></i></a>
								</div>                                        

							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
			@include('Web::customer.menu')
		</div>
	</div>
</div>

<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">

					<?php $url = route('customer.billing.shipping.store'); ?>
					{!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "edit-formas" , 'id'=>'customer_address_form')) !!}
					<div class="contact-us section">
						<div class="container form-main">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">

										{!! Form::Select('type',array(''=>'Select Type','billing'=>'Billing','shipping' => 'Shipping'),Request::old('type'),['id'=>'type', 'class'=>'form-control inputfield', 'required']) !!}

										<span class="errors">
											{!! $errors->first('type') !!}
										</span>

										<input type="hidden" name="users_id" value="{{$user_data->id}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										{!! Form::text('first_name',Request::old('first_name'),['id'=>'first_name', 'class' => 'form-control inputfield','placeholder'=>'Name', 'required']) !!}

										<span class="errors">
											{!! $errors->first('first_name') !!}
										</span>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">

										{!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'Email','required']) !!}

										<span class="errors">
											{!! $errors->first('email') !!}
										</span>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">

										{!! Form::number('phone',Request::old('phone'),['id'=>'phone', 'class' => 'form-control inputfield','placeholder'=>'Enter your phone no', 'required']) !!}

										<span class="errors">
											{!! $errors->first('phone') !!}
										</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">

										{!! Form::number('alternative_phone',Request::old('alternative_phone'),['id'=>'alternative_phone', 'class' => 'form-control inputfield','placeholder'=>'Alternative phone (optional)']) !!}

										<span class="errors">
											{!! $errors->first('alternative_phone') !!}
										</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">

										{!! Form::text('city',Request::old('city'),['id'=>'city', 'class' => 'form-control inputfield','placeholder'=>'City Name', 'required']) !!}

										<span class="errors">
											{!! $errors->first('city') !!}
										</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::text('area',Request::old('area'),['id'=>'area', 'class' => 'form-control inputfield','placeholder'=>'Area Name', 'required']) !!}

										<span class="errors">
											{!! $errors->first('area') !!}
										</span>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										{!! Form::text('post_code',Request::old('post_code'),['id'=>'post_code', 'class' => 'form-control inputfield','placeholder'=>'Post code', 'required']) !!}

										<span class="errors">
											{!! $errors->first('post_code') !!}
										</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">

										{!! Form::textarea('address',Request::old('address'),['id'=>'address', 'class' => 'form-control inputfield','placeholder'=>'Address', 'required','rows'=>'3',]) !!}

										<span class="errors">
											{!! $errors->first('address') !!}
										</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">

										{!! Form::textarea('special_instruction',Request::old('special_instruction'),['id'=>'special_instruction', 'class' => 'form-control inputfield','placeholder'=>'Special instruction for address','rows'=>'3']) !!}

										<span class="errors">
											{!! $errors->first('special_instruction') !!}
										</span>
									</div>
								</div>


								<div class="col-md-12">
									<a style="background: red;color: white" class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Cancel</a>
									<button  class="btn btn-success btn-sm pull-right m-r-10">Update</button>
								</div>
							</div>

							{!! Form::close() !!}

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


<script>
	
</script>
@endsection