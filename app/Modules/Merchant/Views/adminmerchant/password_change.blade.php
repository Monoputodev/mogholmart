@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
	<h2 class="pull-left">
		Merchant Password Change
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>               
</div>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				{!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.merchant.password.update', $data->id],"class"=>"change_password", 'id' => 'change_password']) !!}

				
					@include('Merchant::adminmerchant._form_password_change')


				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>


@endsection