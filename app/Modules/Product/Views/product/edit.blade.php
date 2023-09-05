
@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>
<div class="block-header block-header-2">
	<h2 class="pull-left">
		Product Update
	</h2>
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
	<a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
	<a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
	<a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
	<a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
		            
</div>

<label>Attribute set :</label>	{{isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}  || 
<label>Type :</label>	{{ $data->type}} ||

<label>Merchant Name :</label>	<strong style="color: blue; font-size: 18px;">{{ $data->first_name}} {{ $data->last_name}} 
</strong> 


<div class="block-header m-t-10">
	@include('Product::product.menu_bar',
		[
			'current_tab' => 'basic-information'
			])
		</div>


		<div class="row clearfix">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="body">


						{!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.product.update', $data->id],"class"=>"", 'id' => 'productform']) !!}

						@include('Product::product._basic_form')

						{!! Form::close() !!}

					</div>
				</div>
			</div>
		</div>
		@endsection