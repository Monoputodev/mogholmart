@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">Brand</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->

				@if(isset($brand_list))
				@foreach($brand_list as $data)
				<div class="col-lg-3 col-md-6 col-12 mb-10">
					<div class="single-banner">
						<a target="__blank" href="{{route('brand.slug',['slug' => $data->slug])}}"><img src="{{ URL::to('uploads/brand') }}/{{$data->image_link}}" alt="{{$data->title}}">
						</a>
					</div>
				</div>
				@endforeach
				@endif 

			</div>
		</div>
	</section>

	<div class="col-sm-12 text-right">
		<ul class="pagination">

			@if(count($brand_list) > 0)

			{{$brand_list->links()}}

			@endif
		</ul>
	</div>

@endsection