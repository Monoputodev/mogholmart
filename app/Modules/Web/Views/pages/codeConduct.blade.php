@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">Code Of Conduct</a></li>
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
					<h2 class="heading-title">Code Of Conduct</h2>
					<div class="">
						
						@if(isset($codeofconduct))
						<?php $i=1; ?>
						@foreach($codeofconduct as $key=> $data)
						<h3 class="color title-decimal font30" data-content="{{$i}}">{{isset($key)?$key :''}}</h3>
						<p>
							{!! isset($data)?$data:'' !!}
						</p>

						<hr class="hr-lg">
						<?php $i++; ?>
						@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection