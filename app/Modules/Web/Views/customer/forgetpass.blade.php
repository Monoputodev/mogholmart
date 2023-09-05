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
						<li><a href="#">Dashboard</a></li>
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
					<h1 class="title">Forgot Your Password?</h1>
					<p>Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.</p>
					<?php
					$url = route('customer.resetpassword.sendmail');
					?>
					{!! Form::open(array('url' => $url, 'method' => 'post', 'id' => "registration", 'class' => 'form-horizontal')) !!}

					<fieldset>
						
						<div class="form-group required">
							<label class="col-sm-4 control-label" for="input-email">E-Mail Address</label>
							<div class="col-sm-12">
								<input type="email" name="email" value="" placeholder="E-Mail Address" id="input-email" required="" class="form-control">
							</div>
						</div>
					</fieldset>
					<div class="buttons clearfix">
						<div class="pull-left"><a href="{{route('web.customer.account')}}" class="btn btn-primary btn-custome">Back</a></div>
						<div class="pull-right">
							<input type="submit" value="Submit" class="btn btn-primary">
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
@endsection

