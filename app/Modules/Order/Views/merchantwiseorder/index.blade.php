@extends('Admin::layouts.master')
@section('body')

<div class="block-header block-header-2">
	<h2 class="pull-left">
		Order Search
	</h2>

	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>

</div>

{!! Form::open(['method' =>'GET', 'route' => 'admin.merchant.order.search', 'id'=>'', 'class' => '']) !!}
    <div class="input-group">
        <div class="form-line">            
           {!! Form::text('search_keywords',@Input::get('search_keywords')? Input::get('search_keywords') : null,['class' => 'form-control','placeholder'=>'Type Search Key']) !!}
        </div>
        <span class="input-group-addon">
            <button type="submit" class="btn bg-red waves-effect">
                Search
            </button>
        </span>
    </div>
{!! Form::close() !!}

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					LIST OF MERCHANT
				</h2>
			</div>
			<div class="body">
				<div class="table-responsive">

					<table class="table table-bordered table-striped table-hover dataTable js-basic-example">

						<thead>
							<tr>
								<th>Serial No</th>
								<th> Name</th>
								<th> Mobile No </th>
								<th> Email </th>
								<th> Shop Name</th>
								<th> Status</th>
								<th> Action </th>

							</tr>
						</thead>

						<tbody>

							@if(!empty($data))
							@foreach($data as $key => $values)

							<tr>
								<td>{{$key+1}}</td>
								<td>{{ $values->first_name }}&nbsp;{{ $values->last_name }}</td>
								<td>{{ $values->mobile_no }}</td>
								<td>{{ $values->email }}</td>
								<td>{{ $values->shop_name }}</td>
								<td>
									{{ucfirst($values->status)}}
								</td>

								<td>
									<a style="margin-bottom: 5px" href="{{ route('admin.merchant.order.show', $values->users_id) }}" class="btn btn-info btn-xs" title="Order Details" >Show Order</a>
									</a>
								</td>

							</tr>

							@endforeach
							@endif

						</tbody>


					</table>
				</div>

			</div>
		</div>

	</div>
</div>


<script type="text/javascript">

	$('#data-table-responsive').attr('data-page-length','50');
</script>	
@endsection