@extends('Admin::layouts.master')
@section('body')



<div class="block-header block-header-2">
	<h2 class="pull-left">
	Collectin Search
	</h2> 
	<a style="margin-left: 10px;" href="javascript:history.back()" class="btn btn-warning waves-effect pull-right">Back</a>
                  
</div>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
				{!! Form::open(['method' =>'GET', 'route' => 'admin.collection.search']) !!}

					<?php
					use Illuminate\Support\Facades\URL;
					use Illuminate\Support\Facades\Input;
					?>
					
					<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">

									<div class="form-line">
										{!!  Form::label('payment_type', 'Select Collection Type', array('class' => 'col-form-label')) !!}     

										{!! Form::Select('payment_type',array('cod'=>'Cash On Delivery','online_payment'=>'Online Payment'),Input::old('payment_type'),['id'=>'payment_type', 'class'=>'form-control selectheight']) !!}
										<span class="error">{!! $errors->first('payment_type') !!}</span>
									</div>            

								</div>
							</div>
							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">

									<div class="form-line">
										{!!  Form::label('from_date', 'From Date', array('class' => 'col-form-label')) !!} 

										{!! Form::text('from_date',Input::old('from_date'),['id'=>'from_date', 'class'=>'form-control', 'placeholder'=>'From']) !!}

										<span class="error">{!! $errors->first('from_date') !!}</span>
									</div>            

								</div>
							</div>

							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">

									<div class="form-line">
										{!!  Form::label('to_date', 'To Date', array('class' => 'col-form-label')) !!} 

										{!! Form::text('to_date',Input::old('to_date'),['id'=>'to_date', 'class'=>'form-control ','placeholder'=>'To']) !!}
										<span class="error">{!! $errors->first('to_date') !!}</span>
									</div>            

								</div>
							</div>
							<div class="col-md-6 col-md-offset-3">
								<div class="form-group">
									{!!  Form::label('', '', array('class' => 'col-form-label')) !!}


									{!! Form::submit('Search', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

								</div>
							</div>						
					</div>

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

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
@endsection
