@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
			Password Reset
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>               
</div>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
			{!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.user.password.update', $data->id],"class"=>"form-horizontal", 'id' => 'password_resetfrom']) !!}

			<div class="row">

				@include('User::user._form_password')

			</div>

			{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection