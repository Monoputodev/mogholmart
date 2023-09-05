
{!! Form::model($data, ['method' => 'PATCH', 'files'=> true]) !!}

<div>
	<img  width="100%" height="400" class="img img-responsive" src="{{URL::to($data->image_link)}}/400x400/{{$data->image}}">
</div>

{!! Form::close() !!}