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
						<li><a href="#">Password Changed</a></li>
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
					
					<div class="col-sm-8">
						<div class="well col-sm-12">
							<h2>Change Your Login Password</h2>
							<?php 
							$url = route('password.change');

							?>

							{!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "login-formas" ,'id'=>'resetform')) !!}


							<div class="form-group">
								<label class="control-label" for="password">Password</label>
								{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control inputfield','id'=>'mainpassword', 'placeholder'=>'Password', 'required' ,'title'=>'The password must contain at least 6 digit.' ) ) }}
								<span class="errors">
									{!! $errors->first('password') !!}
								</span>

							</div>
							<div class="form-group">
								<label class="control-label" for="password">Password Confirm</label>
								{{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'class'=>'form-control', 'placeholder'=>'Confirm password','id'=>'confirmpass', 'required','title'=>'This password must be same as password.' ) ) }}

								<span class="errors">
									{!! $errors->first('password_confirmation') !!}
								</span>
							</div>

							<input type="submit" value="Change" class="btn btn-primary pull-left" />  


							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			@include('Web::customer.menu')
		</div>
	</div>
</div>


<style>
	@media(max-width:991px){
		#column-login,.social_login,.socalicon{
			float:none !important;
			width:100%;
		}
		.account-login .btn-primary{
			float:none !important;
		}
		.social_login {
			padding:0 10px;
		}
	}
</style>
<script>
	
	$("#resetform").validate({
		rules:{
			password:{
				required:true,
				minlength:6,
				maxlength:20
			},

			password_confirmation: {
				equalTo: '#mainpassword',
				required:true,
				
			},

		},
		messages:{

			mainpassword:'Please enter password.',
			password_confirmation:'Please retype your password.',

		}
	});

</script>
@endsection