@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
    <h2 class="pull-left">
       Commission Setting Update <strong style="color: blue; font-size: 20px; font-weight: bold;">( Default commission is 2.00 % , You can change it as your requeirment. )</strong>
    </h2> 
    <a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>               
</div>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">

				{!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.comission.setting.update', $data->id],"class"=>"", 'id' => '']) !!}

					@include('Comission::comissionsetting._form')

				{!! Form::close() !!}

			</div>
		</div>
	</div>

</div>

@endsection