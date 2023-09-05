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
						<li><a href="#">Dashboard</a></li>
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

					<div class="well ">
						<h2>Hay, {{$data->first_name}} {{$data->last_name}}</h2>
						<p><strong>You are logged in!</strong></p>
						<p>You can now able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made. Thank you.</p>
					</div>
				</div>
				@include('Web::customer.menu')
			</div>
		</div>
	</div>

@endsection