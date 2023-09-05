
{!! Form::open(['route' => 'admin.product.custom.form.submit', 'id'=>'orderreport', 'class' => 'form-horizontal']) !!}

<div class="row">
	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>Select Merchant</label>

				{!! Form::Select('merchant_id', $merchant_lists ,Input::old('merchant_id'),['id'=>'merchant_id', 'class'=>'form-control selectheight']) !!}
				
			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>From Date</label>
				{!! Form::text('from_date',Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control z_index', 'placeholder'=>'yyyy-mm-dd']) !!}
				
			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>To Date</label>
				{!! Form::text('to_date',Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control z_index','placeholder'=>'yyyy-mm-dd']) !!}
				
			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				
				<label>&nbsp;</label><br/>
				{!! Form::submit('Search', array('class'=>'btn btn-w-lg btn-info','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
				
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}


<script type="text/javascript">
	
	$('#from_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});
	$('#to_date').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});

</script>