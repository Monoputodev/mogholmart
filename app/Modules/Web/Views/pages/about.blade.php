@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="contact-us section">
	<div class="container">
		<div class="row">
			<div id="content" class="col-md-12 form-main">
				
					<h2 class="heading-title">About Us</h2>
					<div class="">
						
						{!! isset($about_us)? $about_us->description: 'Content will update soon.' !!}
					</div>
				
			</div>
		</div>
	</div>
</div>

@endsection