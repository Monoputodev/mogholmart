@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Product Product Review Update
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
    <a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
    <a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
    <a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
    <a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
    
	</br> 
	<label>Attribute set :</label>	{{isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}  || 
				<label>Type :</label>	{{ $data->type}}

				@include('Product::product.menu_bar',
				[
					'current_tab' => 'product_review'
				])
				            
</div>


<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
			{!! Form::model($review_data,['method' => 'POST', 'files'=> true,"class"=>"", 'id' => 'productreview']) !!}

			@include('Product::product._product_review_form')

			{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>
@endsection