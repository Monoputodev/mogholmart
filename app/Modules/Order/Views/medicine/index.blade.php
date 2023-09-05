@extends('Admin::layouts.master')
  @section('body')
    <div class="block-header">
    <h2>{{__('messages.dashboard')}}</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
	@if(count($data)>0)
	@foreach($data as $values)
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<a href="{{ route('admin.medicine.view',$values->id) }}" style="text-decoration: none;" class="info-box bg-green hover-expand-effect mousepointer">
			<div class="icon">
				<i class="material-icons">devices</i>
			</div>
			<div class="content">
				<div class="text">{{$values->first_name}}</div>
				<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">({{$values->prescriptions}})</div>
			</div>
		</a>
	</div>
	@endforeach
	@endif


</div>

@endsection