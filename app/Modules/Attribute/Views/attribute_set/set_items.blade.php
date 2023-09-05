@extends('Admin::layouts.master')
@section('body')


<div class="block-header block-header-2">
	<h2 class="pull-left">
		Attribute Set Item
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
	
</div>

<!--Filter :Starts -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF ATTRIBUTE
					
				</h2>
			</div>
			<div class="body">
				
				<div class="row">	

					<div class="col-md-6">

						<h4>Unassigned Attribute</h4>

						{!! Form::open(['route' => 'admin.attribute.set.items.assigned.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

						<input type="hidden" name="attribute_set_id" value="{{$attribute_set_id}}">
						
						<div class="table-responsive">

							<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
								<thead>
									<th>#</th>

									<th> Title</th>
									<th>Type</th>
								</thead>

								<tbody>
									
									@if(count($attribute_list) > 0)
									@foreach($attribute_list as $attribute)

									<tr>
										<td>
											<input type="checkbox" name="unassigned_attr[]" value='{{$attribute->id}}'>
										</td>
										
										<td>
											{{$attribute->frontend_title}}
										</td>
										<td>
											{{$attribute->type}}
										</td>

									</tr>
									
									@endforeach
									@endif

								</tbody>

							</table>

							<div class="col-md-12">
								{!! Form::submit('Assigned', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
							</div>
							
						</div>

						{!! Form::close() !!}

					</div>


					<div class="col-md-6 ">

						<h4>Assigned Attribute</h4>

						{!! Form::open(['route' => 'admin.attribute.set.items.unassigned.store',  'files'=> true, 'class' => 'form-horizontal']) !!}

						<input type="hidden" name="attribute_set_id" value="{{$attribute_set_id}}">

						<div class="table-responsive">

							<table class="table table-bordered table-striped table-hover dataTable js-basic-example">
								<thead>
									<th>#</th>
									
									<th> Title</th>
									<th>Type</th>
								</thead>

								<tbody>

									@if(count($asssigned_attribute) > 0)
									@foreach($asssigned_attribute as $attribute)

									<tr>
										<td>
											<input type="checkbox" name="assigned_attr[]" value="{{$attribute->id}}">
										</td>
										
										<td>
											{{$attribute->relAttribute->frontend_title}}
										</td>
										<td>
											{{$attribute->relAttribute->type}}
										</td>
									</tr>
									
									@endforeach
									@endif
									
								</tbody>
							</table>
							<div class="col-md-12">
								{!! Form::submit('Unassigned', ['class' => 'btn btn-warning pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
							</div>

						</div>
						{!! Form::close() !!}
					</div>

				</div>
				

			</div>
		</div>
	</div>

	@endsection
