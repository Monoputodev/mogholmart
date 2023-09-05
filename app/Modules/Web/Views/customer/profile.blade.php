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
						<li><a href="#">Profile</a></li>
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
				<div class="row">
					
					<div class="col-sm-3 box-shadow">
						@if(Auth::user()->image !='')
						<img src="{{URL::to('uploads/user')}}/{{Auth::user()->image}}" class="img-circle" style="max-height: 200px;">
						@else
						<img src="{{URL::to('logo/images.png')}}" class="img-circle" style="max-height: 100px;" >
						@endif
					</div>

					<div class="col-sm-6">
						<h4>Name: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
						<h6>Email: {{Auth::user()->email}}</h6>
						<h6>Contact No: {{Auth::user()->mobile_no}}</h6>
					</div>

					<div class="col-sm-3">
						<a data-toggle="modal" data-target="#edit_profile" class="btn btn-primary pull-right" href="#"><i class="fa fa-cog"></i>
							Update
						</a>
					</div>

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

					<?php $url = route('customer.do_customer_edit_info'); ?>
					{!! Form::open(array('url' => $url, 'files'=> true, 'method' => 'post', 'class' => "edit-formas")) !!}
					<div class="contact-us section">
						<div class="container form-main">
							<div class="row">
								
								<div class="col-md-3">
									<div class="form-group">
										<input name="first_name" required="required" type="text" class="form-control font-black "  placeholder="First Name *" value="{{$customer_data->first_name}}">

										<input type="hidden" name="user_id" value="{{$customer_data->id}}">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input name="last_name" required="required" type="text" class="form-control font-black "  placeholder="Last Name *" value="{{$customer_data->last_name}}">

										<input type="hidden" name="user_id" value="{{$customer_data->id}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input name="email" required="required" type="email" class="form-control font-black"  placeholder=" Enter your email address *" value="{{$customer_data->email}}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<input name="mobile_no" required="required" type="number" class="form-control font-black"  placeholder=" Enter your phone number *" value="{{$customer_data->mobile_no}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input name="post_code"  type="text" class="form-control font-black"  placeholder=" Enter your post code*" value="{{$customer_data->post_code}}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">

										<div class="form-line">
											{!! Form::label('image', 'Image', array('class' => 'col-form-label')) !!}
											<span class="error">Supported format :: jpeg,png,jpg,gif & file size max :: 1MB</span>

											<div style="position:relative;">
												<a class='btn btn-primary btn-sm font-10' href='javascript:;'>
													Choose File...
													<input name="image" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
												</a>
												&nbsp;
												<span class='label label-info' id="upload-file-info"></span>


											</div>

											@if(isset($customer_data['image'] ) && !empty($customer_data['image']) )
											<a target="_blank" href="{{URL::to('')}}/uploads/user/{{$customer_data->image}}" style="margin-top: 5px;" class="btn btn-primary btn-sm font-10">
												<img src="{{URL::to('')}}/uploads/user/{{$customer_data->image}}" style="height: 50px;" alt="{{$customer_data->image}}" >
													
												</img>
											</a>
											@endif
										</div>
									</div> 
								</div>

								<div class="col-md-12">
									<a style="background: red;color: white" class="btn btn-danger btn-sm pull-right" data-dismiss="modal">Cancel</a>
									<button type="submit" class="btn btn-success btn-sm m-r-10 w-25 pull-right">Update</button>
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

@endsection