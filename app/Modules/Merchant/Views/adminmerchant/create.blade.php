@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
			Merchant Add
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>               
</div>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
			{!! Form::open(['route' => 'admin.merchant.store',  'files'=> true, 'id'=>'userform', 'class' => 'form-horizontal']) !!}

			@include('Merchant::adminmerchant._form')

			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
