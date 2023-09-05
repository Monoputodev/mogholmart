@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="block-header block-header-2">
<h2 class="pull-left">
Product EMI Update
</h2>
<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
<a style="margin-left: 10px;" href="{{route('admin.product.create')}}" class="btn btn-primary waves-effect pull-right">Add Product</a>
<a  style="margin-left: 10px;" href="{{ route('admin.product.active') }}" class="btn btn-success waves-effect pull-right">Active Product</a>
<a   style="margin-left: 10px;"href="{{ route('admin.product.inactive') }}" class="btn btn-warning waves-effect pull-right">InActive Product</a>
<a  style="margin-left: 10px;"href="{{ route('admin.product.cancel') }}" class="btn btn-danger waves-effect pull-right">Cancel Product</a>
</div>

<label>Attribute set :</label>	{{isset($data->relAttribute->title)?ucfirst($data->relAttribute->title):''}}  || 
<label>Type :</label>	{{ $data->type}} 


<div class="block-header m-t-10">
@include('Product::product.menu_bar',
[
'current_tab' => 'product_emi'
])
</div>
<div class="row clearfix">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="body">

			{!! Form::model($data,['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.product.emi.update',$data->id],"class"=>"", 'id' => 'seoform']) !!}


			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="form-group">

						<div class="form-line">
							{!!  Form::label('is_emi', 'Do you want to apply EMI in this product?', array('class' => 'col-form-label')) !!}

							{!! Form::Select('is_emi',array('no'=>'NO','yes'=>'YES'),Input::old('is_emi'),['id'=>'is_emi', 'class'=>'form-control selectheight']) !!}
							<span class="error">{!! $errors->first('is_emi') !!}</span>
						</div>            

					</div>
				</div>
				<div class="col-md-6 col-md-offset-3">
					<div class="form-group">
						{!!  Form::label('', '', array('class' => 'col-form-label')) !!}


						{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

					</div>
				</div>
			</div>

			{!! Form::close() !!}

		</div>
	</div>
</div>
</div>

@endsection