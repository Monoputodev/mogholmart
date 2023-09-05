@extends('Admin::layouts.master')
@section('body')
<div class="block-header block-header-2">
	<h2 class="pull-left">
		Product Inventory 
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>
<?php
$inventory = [
	'asc' => 'ASC',
	'desc' => 'DESC'
];

$inventory_status =  [
	'' => 'Select Status',
	'active' => 'Active',
	'inactive' => 'Inactive',
	'cancel' => 'Cancel'
];
?>


<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">

			<div class="body">
				{!! Form::open(['method' =>'GET', 'route' => 'admin.product.inventory.search', 'id'=>'', 'class' => '']) !!}
				<div class="input-group">

					<div class="col-md-2 col-sm-2" >

						<div class="form-line">            
							{!! Form::text('item_no',@Request::get('item_no')? Request::get('item_no') : null,['class' => 'form-control','placeholder'=>'Type item number']) !!}
						</div>


					</div>

					<div class="col-md-2 col-sm-2" >

						<div class="form-line">     
							{!! Form::text('title',Request::get('title')? Request::get('title') : null,['class' => 'form-control','placeholder'=>'Type product name']) !!}
						</div>
					</div>

					<div class="col-md-3 col-sm-3" >
						<div class="form-line">   

							{!! Form::Select('status',$inventory_status,Request::get('status')? Request::get('status') : Request::old('status'),['id'=>'status', 'class'=>'form-control ']) !!}
						</div>
					</div>

					<div class="col-md-3 col-sm-3" >

						<div class="form-line">   
							{!! Form::Select('inventory',$inventory,Request::get('inventory')? Request::get('inventory') : Request::old('inventory'),['id'=>'inventory', 'class'=>'form-control ']) !!}
						</div>
					</div>
					<div class="col-md-2 col-sm-2" >

						<div class="form-group">   
							<button type="submit" class="btn bg-red waves-effect">
								Search
							</button>
						</div>
					</div>

				</div>


				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<!--Filter :Starts -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF INVENTORY DATA
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">
					@if(count($data) > 0)
					<div>
						{{$data->links()}}
					</div>
					@endif
					<table class="table table-bordered table-striped table-hover dataTable js-basic-example">

						<thead>
							<tr>
								<th> No</th>
								<th> Item No </th>
								<th> Product Name </th>
								<th> Sell Price</th>
								<th> List Price</th>
								<th> Inventory</th>
								<th> Status</th>
								<th> Action </th>

							</tr>
						</thead>

						<tbody>

							@if(!empty($data))
							@foreach($data as $key => $values)


							<tr>
								<td>{{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}</td>
								<td>{{$values->item_no}}</td>
								<td>{{ $values->title }}</td>
								<td>TK {{ number_format($values->sell_price,2)}}</td>
								<td>TK {{number_format($values->list_price,2)}}</td>

								<td>{{$values->quantity}}</td>

								<td>
									
									@if($values->status=='active')
									<button type="button" class="btn btn-success btn-sm">{{ucfirst($values->status)}}</button>
									@elseif($values->status=='inactive')
									<button type="button" class="btn btn-warning btn-sm">{{ucfirst($values->status)}}</button>
									@else
									<button type="button" class="btn btn-danger btn-sm">{{ucfirst($values->status)}}</button>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.product.inventory', $values->id) }}" class="demo-google-material-icon" ><i class="material-icons">border_color</i></a>

								</td>

							</tr>

							@endforeach
							@endif

						</tbody>


					</table>
					@if(count($data) > 0)
					<div>
						{{$data->links()}}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>


@endsection