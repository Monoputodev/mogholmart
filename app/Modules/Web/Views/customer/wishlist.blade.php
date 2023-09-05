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
						<li><a href="#">Wishlist</a></li>
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
				<fieldset>
					<legend>Wish List 
						<a href="javascript:history.back()" class="btn btn-warning btn-sm pull-right m-r-10 btn-radious">Back</a></legend>
					</fieldset>
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								<div class="all-instructors mb-30">
									<div class="table-responsive">

										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>#</th>
													<th> Image </th>
													<th> Product </th>
													<th> Action </th>
												</tr>
											</thead>
											<tbody>
												@if(!empty($wishlist_data))
												@foreach($wishlist_data as $key => $wishlist)

												<tr>
													<td>{{ ($wishlist_data->currentpage()-1) * $wishlist_data->perpage() + $key + 1 }}</td>
													<td>
														@if($wishlist->relProduct->image !='')
														<img  src="{{URL::to('uploads/product/'.$wishlist->relProduct->product_id.'/50x50/'.$wishlist->relProduct->image)}}" alt="">
														@else
														<img src="{{URL::to('logo/nofound.jpg')}}" alt="{{$wishlist->relProduct->product_title}}" class="img-responsive">
														@endif        					
													</td>
													<td>
														@if(isset($wishlist->relProduct) && !empty($wishlist->relProduct))
														<a href="{{route('product.slug',['slug' => $wishlist->relProduct->product_slug])}}">
															{{$wishlist->relProduct->product_title}}
														</a><br>
														Code: {{ $wishlist->relProduct->item_no }}
														@endif        					
													</td>
													<td align="center">
														@if(isset($wishlist->relProduct) && !empty($wishlist->relProduct))
														<a class="btn btn-info btn-sm" target="__blank" href="{{route('product.slug',['slug' => $wishlist->relProduct->product_slug])}}"><i class="fa fa-eye"></i>
															Details
														</a>
														<a class="btn btn-danger btn-sm" href="{{route('customer.remove.to.wishlist',['id' => $wishlist->product_id])}}" onclick="return confirm('Are you sure to Delete?')" ><i class="fa fa-times"></i>
															Remove
														</a>

														@endif        					
													</td>
												</tr>

												@endforeach
												@endif

											</tbody>
										</table>
										<div class="col-sm-12 text-right">
											<ul class="pagination">
												@if(count($wishlist_data) > 0)
												{{$wishlist_data->links()}}
												@endif
											</ul>
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
				@include('Web::customer.menu')
			</div>
		</div>
	</div>

	@endsection