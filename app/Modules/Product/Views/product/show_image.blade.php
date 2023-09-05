
{!! Form::model($data, ['method' => 'PATCH', 'files'=> true]) !!}

<div>
	<img  width="100%" height="270" class="img img-responsive" src="{{URL::to($data->image_link)}}/orginal_image/{{$data->image}}">
</div>

{!! Form::close() !!}