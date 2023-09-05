@extends('Web::layouts.master')

@section('body')
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{URL::to('/')}}">Home</a><i class="ti-arrow-right"></i></li>
						<li><a href="{{route('web.customer.account')}}">Account <i class="ti-arrow-right"></i></a></li>
						<li><a href="#">Register</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="contact-us" class="contact-us section">
	<div class="container">
		<div class="contact-head">
			<div class="row">
				<div id="content" class="col-sm-9 form-main">
					<h1 class="title">Sign Up Account</h1>
					<h6>If you already have an account with us, please sign in at the 
						<a href="{{route('web.customer.account')}}"><b class="btn-custome">Sign In</b></a> section.</h6>
					<br>
					<?php
					$url = route('customer.do.register');
					?>
					{!! Form::open(array('url' => $url, 'method' => 'post', 'id' => "registration", 'class' => 'form-horizontal')) !!}

					<fieldset id="account">
						<legend>Your Personal Details</legend>
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="email">E-Mail</label>    
							<div class="col-sm-9">
								{!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control','placeholder'=>'Email','title'=>'Enter Valid Email.']) !!}
								<span class="errors">
									{!! $errors->first('email') !!}
								</span>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="first_name">First Name</label>     
							<div class="col-sm-9">
								{!! Form::text('first_name',Request::old('first_name'),['id'=>'first_name', 'class' => 'form-control','placeholder'=>'First Name','title'=>'First Name', 'required']) !!}

								<span class="errors">
									{!! $errors->first('first_name') !!}
								</span>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="last_name">Last Name</label>    
							<div class="col-sm-9">
								{!! Form::text('last_name',Request::old('last_name'),['id'=>'last_name', 'class' => 'form-control','placeholder'=>'First Name','title'=>'First Name', 'required']) !!}

								<span class="errors">
									{!! $errors->first('last_name') !!}
								</span>
							</div>
						</div>
						
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="mobile_no">Telephone</label>    
							<div class="col-sm-9">
								{!! Form::number('mobile_no',Request::old('mobile_no'),['id'=>'mobile_no', 'class' => 'form-control','placeholder'=>'Telephone', 'required']) !!}
								<span class="errors">
									{!! $errors->first('mobile_no') !!}
								</span>

							</div>
						</div>
						
					</fieldset>
					<fieldset>
						<legend>Your Password</legend>
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="password">Password</label>
							    
							<div class="col-sm-9">
								{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control inputfield', 'placeholder'=>'Password', 'required' ,'title'=>'The password must contain at least 6 digit.','id'=>'mainpassword' ) ) }}
								<span class="errors">
									{!! $errors->first('password') !!}
								</span>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-3 control-label" for="password_confirmation">Password Confirm</label>
							    
							<div class="col-sm-9">
								{{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'class'=>'form-control', 'placeholder'=>'Confirm password', 'required','title'=>'This password must be same as password.' ) ) }}

								<span class="errors">
									{!! $errors->first('password_confirmation') !!}
								</span>
								
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Newsletter</legend>
						<div class="form-group">
							<label class="col-sm-2 control-label">Subscribe</label>
							<div class="col-sm-10"><label class="radio-inline">
								<input type="radio" name="newsletter" value="1" />
							Yes</label>
							<label class="radio-inline">
								<input type="radio" name="newsletter" value="0" checked="checked" />
							No</label>
						</div>
					</div>
				</fieldset>
				<div class="buttons">
					<div class="pull-right">I have read and agree to the <a href="{{route('web.terms.condition')}}" class="agree"><b>Terms & Condition</b></a>
						<input type="checkbox" name="agree" value="1" />
						&nbsp;
						<input type="submit" value="Continue" class="btn btn-primary" />
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			@include('Web::customer.menu')
		</div>
	</div>
</div>
</div>
</section>


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
	$(function() {
            // highlight
            var elements = $("input[type!='submit'], textarea, select");
            elements.focus(function() {
            	$(this).parents('li').addClass('highlight');
            });
            elements.blur(function() {
            	$(this).parents('li').removeClass('highlight');
            });

            $("#registration").validate({
            	rules:{
            		first_name:{
            			required:true
            		},
            		last_name:{
            			required:true
            		},
            		
            		mobile_no:{
            			number:true,
            			minlength:11,
            		},
            		post_code:{
            			required:true,
            			minlength:6,
            			maxlength:8
            		},
            		password:{
            			required:true,
            			minlength:6,
            			maxlength:20
            		},
            		password_confirmation:{
            			required:true,
            			equalTo: '#mainpassword',
            		},

            	},
            	messages:{
            		first_name:'Please enter your first name.',
            		last_name:'Please enter your last name.',
            		
            		password:'Please enter password.',
            		password_confirmation:'Please retype your password.',
            		post_code: 'Plese enter your valid post code.',
            		mobile_no: 'Plese enter your mobile number.'
            		
            	}
            });
        });
</script>
@endsection