@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="#">Faq</a></li>
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
					<h2 class="heading-title">Frequently Asked Questions</h2>
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->


						@if(isset($faqdata))
						@foreach($faqdata as $key=> $data)
						<div class="panel panel-default checkout-step-{{ $key+1 }}">

							<!-- panel-heading -->
							<div class="panel-heading">
								<h4 class="unicase-checkout-title">
									<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse{{ $key+1 }}">
										<span>{{isset($data->title)?$data->title :''}}
									</a>
								</h4>
							</div>
							<!-- panel-heading -->

							<div id="collapse{{ $key+1 }}" class="panel-collapse collapse in">

								<!-- panel-body  -->
								<div class="panel-body">
									{!! isset($data->description)?$data->description:'' !!}
								</div>
								<!-- panel-body  -->

							</div><!-- row -->
						</div>

						@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection
