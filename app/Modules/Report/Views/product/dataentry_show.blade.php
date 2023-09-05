


<div class="row">
	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>Select Admin</label>

				{!! Form::Select('created_by', $admin_lists ,Input::old('created_by'),['id'=>'created_by', 'class'=>'form-control selectheight']) !!}

			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>From Date</label>
				{!! Form::text('from_date',Input::old('from_date'),['id'=>'from_date_de', 'class'=>'form-control from_date_de z_index', 'data-format'=>'yyyy-mm-dd']) !!}

			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>To Date</label>
				{!! Form::text('to_date',Input::old('to_date'),['id'=>'to_date_de', 'class'=>'form-control to_date_de  z_index','data-format'=>'yyyy-mm-dd']) !!}

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




<script type="text/javascript">
	
	$('.from_date_de').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});
	$('.to_date_de').datepicker({
		language: 'en',
        dateFormat: 'yyyy-mm-dd',
        autoClose: true,
	});

</script>

<script type="text/javascript">
	$(document).ready(function(){ 
	    $("input").attr("autocomplete", "off"); 
	});
</script>