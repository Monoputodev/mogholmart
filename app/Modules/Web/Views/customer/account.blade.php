@extends('Web::layouts.master')
@section('body')


<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{route('web.customer.account')}}">Account <i class="ti-arrow-right"></i></a></li>
						<li><a href="#">Login</a></li>
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
					<div class="col-md-6">
						<div class="well">
							<h2 class="title">New Customer</h2>
							<p><strong>Register Account</strong></p>
							<p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
							<a href="{{route('web.customer.register')}}" class="btn btn-primary btn-custome">Continue</a>
						</div>
					</div>
					<div class="col-md-6">
					<h2 class="">Welcome, Please SIGN IN!</h2>

						<?php $url = route('customer.post.login'); ?>

						{!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "login-formas" ,'id'=>'loginform')) !!}

						<div class="form-group">
							<label class="control-label" for="email">E-Mail Address</label>


							{!! Form::email('email',Request::old('email'),['id'=>'email', 'class' => 'form-control inputfield required email','placeholder'=>'E-Mail Address', 'required']) !!}
							<span class="errors">
								{!! $errors->first('email') !!}
							</span> 
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Password</label>
							{{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control inputfield', 'placeholder'=>'Password', 'required' ) ) }}                                         
							<span class="errors">
								{!! $errors->first('password') !!}
							</span>
						</div>

						<input type="submit" value="Login" class="btn btn-info pull-left " />  


						{!! Form::close() !!}

						<column id="column-login" class="col-sm-8 pull-right">
							<div class="row">

								<div class="social_login pull-right" id="so_sociallogin">
									<a href="{{route('customer.resetpassword')}}">Forgotten Password</a>
								</div>
							</div>
						</column>

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

@endsection