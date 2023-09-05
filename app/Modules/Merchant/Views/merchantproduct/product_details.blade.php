@extends('Merchant::merchant.merchant_master') 
@section('body')

<?php
 if (isset($product->attribute_set_id)) {
		$old_attributes = [];
		$old_attributes_data = $product->relProductAttribute;

		if(count($old_attributes_data) > 0){
			foreach ($old_attributes_data as $oa_key => $oa_value){
				$old_attributes[$oa_value->attribute_code] = $oa_value;
			}
		}

}
?>

	<style type="text/css">
		.attribute_item_container_2 {}

		.attribute_item_container_2 label {
			margin-right: 10px;
		}

		.attribute_item_container_2 label input {}

		.attribute_checkbox_style {
			margin-right: 7px;
		}
	</style>
	<section class="top-teacher-area section-padding-50" style="background-image: url({{ asset('frontend') }}/img/core-img/texture.png);">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading">
						<h3>{{ isset($varifaid_user->shop_name)?ucfirst($varifaid_user->shop_name):''}}</h3><br>
						<h3>Product Details :: {{ isset($product->title)?ucfirst($product->title):''}} -- <?php
											$item_no_explode = explode('-',$product->item_no);

											if(isset($item_no_explode)){
												


												for($i=2;$i<(count($item_no_explode) - 1);$i++){
													echo $item_no_explode[$i];

													if($i < (count($item_no_explode) - 2)){
														echo '-';
													}
												}
											}



										?> <!-- {{ isset($product->item_no)?ucfirst($product->item_no):''}} -->
						</h3>

						<a href="javascript:history.back()" class="btn-style-1 float-right">Back</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Basic Information</h4>

							<div class="profile-details">
								<b>Title</b> : {{ isset($product->title)?ucfirst($product->title):''}}
								<br/>
								<b>Product code</b> : <?php
											$item_no_explode = explode('-',$product->item_no);

											if(isset($item_no_explode)){
												


												for($i=2;$i<(count($item_no_explode) - 1);$i++){
													echo $item_no_explode[$i];

													if($i < (count($item_no_explode) - 2)){
														echo '-';
													}
												}
											}



										?>  <br/>
							</div>

						</div>
					</div>

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Image</h4>

							<div class="profile-details">
								<div class="row">
									@if (isset($imagedata) && !empty($imagedata)) @foreach ($imagedata as $image)
									<div class="col-md-1 imgdiv">
										<div>
											<img width="100" class="img img-responsive" src="{{URL::to($image->image_link)}}/400x400/{{$image->image}}">
										</div>
									</div>
									@endforeach @endif
								</div>
							</div>

						</div>
					</div>

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Description</h4>

							<div class="profile-details">
								<b>Description</b> : {!! isset($product->short_description)?ucfirst($product->short_description):''!!}
								<br/>
								<b>Specification</b> : <span class="specification-img">{!! isset($product->specification)?ucfirst($product->specification):''!!}</span>  <br/>
								<b>Measurment Point</b> : {!! isset($product->description)?ucfirst($product->description):''!!}<br/>
							</div>

						</div>
					</div>

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>SEO</h4>

							<div class="profile-details">
								<b>Meta Title</b> : {!! isset($seo->meta_title)?ucfirst($seo->meta_title):''!!}
								<br/>
								<b>Meta Keywords</b> : {!! isset($seo->meta_keywords)?ucfirst($seo->meta_keywords):''!!}<br/>
								<b>Meta Description</b> : {!! isset($seo->meta_description)?ucfirst($seo->meta_description):''!!}<br/>
							</div>

						</div>
					</div>

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Category</h4>

							<div class="profile-details">
								<ul class="product-category">
									@if(isset($product_category) && count($product_category) > 0)
									<?php $total_rows = 1; ?> @foreach($product_category as $key => $category)
									<li>

										<span><?=$total_rows?> . {{$category->title}}</span>
									</li>
									<?php $total_rows++; ?> @endforeach @endif

								</ul>
							</div>

						</div>
					</div>
				<?php 

					 if (isset($product->attribute_set_id)) {

				 ?>
					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Atribute</h4>

							<div class="profile-details">
								<?php
								if(count($attributes) > 0){
									foreach ($attributes as $attr){
										$attr_item = $attr;
										$attr_options = [];

										if($attr_item->type =='dropdown'){
											$attr_options[''] = 'Select one option';
										}

										if(!empty($attr_item)){
											$attr_options_data = $attr->relAttributeOption;
											if(count($attr_options_data) > 0){
												foreach ($attr_options_data as $option){
													$attr_options[$option->frontend_title] = $option->backend_title;
												}
											}
										}

											$attr_val = '';
											if(isset($old_attributes[$attr_item->code_column])){
												$attr_val = $old_attributes[$attr_item->code_column]->attribute_data;
											}
								?>


									{!! Form::label($attr_item->code_column,$attr_item->backend_title) !!} @if($attr_item->type == 'textarea') {!! Form::textarea('Attribute['.$attr_item->code_column.']',
									($attr_val != '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
									=> 'form-control']) !!} @elseif($attr_item->type =='text') {!! Form::text('Attribute['.$attr_item->code_column.']',($attr_val
									!= '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
									=> 'form-control']) !!} @elseif($attr_item->type =='checkbox')

									<?php
									$attr_counter = 0;
									$attr_val = explode('==',$attr_val);
									?>
										<div class="row">
											<div class="container-fluid attribute_item_container_{{ $attr_item->id }}">
												@if(count($attr_options) > 0) @foreach($attr_options as $opt_item_key => $opt_item_value)
												<?php $attr_counter++; ?>
												<label for="attribute_{{$attr_item->code_column.'_'.$attr_counter}}" class="pull-left attribute_checkbox_style">
												{!! Form::checkbox('Attribute['.$attr_item->code_column.'][]' , $opt_item_key, (in_array($opt_item_key,$attr_val))?'checked':'' ,['class' => '','id'=>'attribute_'.$attr_item->code_column.'_'.$attr_counter]) !!} {{ $opt_item_value }}
											</label> @endforeach @endif
											</div>
										</div>

										@else {!! Form::text('Attribute['.$attr_item->code_column.']',($attr_val != '')?str_replace('==','',$attr_val):Input::old('Attribute['.$attr_item->code_column.']'),['id'=>$attr_item->code_column,'class'
										=> 'form-control']) !!} @endif


										<?php
								}
							}
							?>
							</div>

						</div>
					</div>
				<?php 

					 }

				 ?>
					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Inventory</h4>

							<div class="profile-details">
								<b>Ware House</b> :{{ isset($product->warehouse)?ucfirst($product->warehouse):''}}
								<br/>
								<b>Quentity</b> : {{ isset($product->quantity)?ucfirst($product->quantity):''}}<br/>
								<b>Note</b> :: {{ isset($product->note)?ucfirst($product->note):''}}<br/>
							</div>

						</div>
					</div>

					<div class="clever-description">
						<div class="all-instructors mb-30">
							<h4>Review</h4>

							<div class="profile-details">
								<div class="table-responsive">

									<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
										<thead>
											<tr>
												<th>Serial No</th>
												<th> Rating </th>
												<th> Product Name </th>
												<th> Customer Name</th>
												<th> Review Title</th>
												<th> Review</th>
												<th> Status</th>

											</tr>
										</thead>
										<tbody>
											@if(isset($review_data) &&count($review_data) > 0)
											<?php
										$total_rows = 1;
										?>
												@foreach($review_data as $values)
												<tr>
													<td>
														<?=$total_rows?>

													</td>
													<td>
														{{$values->rating_value_score}}
													</td>
													<td>
														@if (isset($values->relProduct)) {{$values->relProduct->product_title}} @endif

													</td>
													<td>
														@if (isset($values->relUser)) {{$values->relUser->first_name}} {{$values->relUser->last_name}} @endif
													</td>
													<td>
														{{$values->title}}
													</td>
													<td>
														{!!$values->review!!}

													</td>
													<td>

														@if ($values->status=='inactive')
														<p style="color: red">{{$values->status}}</p>

														@elseif($values->status=='active')

														<p style="color: green">{{$values->status}}</p>

														@elseif($values->status=='cancel')

														<p style="color: orange">{{$values->status}}</p>
														@endif

													</td>

												</tr>
												<?php
											$total_rows++;
										?> @endforeach @endif

										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>

		</div>
	</section>
@endsection