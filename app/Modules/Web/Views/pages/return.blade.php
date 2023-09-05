@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">{{ $data->title }}</a></li>
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
					<h2 class="heading-title">{{$data->title}}</h2>
					<div class="">
						
						{!! isset($data->description)? $data->description: 'Content will update soon.' !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection