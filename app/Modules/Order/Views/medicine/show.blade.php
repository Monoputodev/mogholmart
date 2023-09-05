@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Medicine Order List
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF ORDER DATA
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">

					<table class="table table-bordered table-striped table-hover">

						<thead>
							<tr>
								<th>Serial No</th>
								<th> Comment </th>
								<th> Prescription </th>
								

							</tr>
						</thead>

						<tbody>

							@if(!empty($data))
							@foreach($data as $key => $values)

							
							<tr>
								<td>{{$key+1}}</td>
								
								<td>{{$values->comment}}</td>
								<td><a target="__blank" href="{{URL::to('uploads/prescription')}}/{{$values->user_id}}/{{$values->image_link}}"><img width="100" class="img img-responsive" src="{{URL::to('uploads/prescription')}}/{{$values->user_id}}/{{$values->image_link}}" style="border: 1px solid;" title="Click Here For Full View"></a></td>
							</tr>

							@endforeach
							@endif

						</tbody>


					</table>
					<table>
						
						<thead>
							<tr>
								<th>{{$data->links()}}</th>
							</tr>
						</thead>
						
					</table>
				</div>

			</div>
		</div>

	</div>
</div>



@endsection