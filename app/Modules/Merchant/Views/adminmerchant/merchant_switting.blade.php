@extends('Admin::layouts.master')
@section('body')

<?php
use Illuminate\Support\Facades\Input;
?>

<div class="row clearfix">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">

				{!! Form::open(['route' => 'admin.merchant.switching.store',  'files'=> true, 'id'=>'general_file', 'class' => 'form-horizontal']) !!}

				<div class="row">

					<div class="col-md-6">
						<div class="form-group">

							<div class="form-line">
								{!! Form::label('merchant_id_form', 'Merchant List From', array('class' => 'col-form-label')) !!}     

								{!! Form::Select('merchant_id_form', $merchant_lists ,Input::old('merchant_id_form'),['id'=>'merchant_id_form', 'class'=>'form-control selectheight select2class']) !!}
								<span class="error">{!! $errors->first('merchant_id_form') !!}</span>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">

							<div class="form-line">
								{!! Form::label('merchant_id_to', 'Merchant List To', array('class' => 'col-form-label')) !!}     

								{!! Form::Select('merchant_id_to', $merchant_lists ,Input::old('merchant_id_to'),['id'=>'merchant_id_to', 'class'=>'form-control selectheight select2class']) !!}
								<span class="error">{!! $errors->first('merchant_id_to') !!}</span>
							</div>
						</div>
					</div>
					<div class="col-md-12">

						{!! Form::submit('Switch', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

					</div>
				</div>

				{!! Form::close() !!}   

			</div>
		</div>
	</div>
</div>

<script>
	$(function() {

		var elements = $("input[type!='submit'], textarea, select");
		elements.focus(function() {
			$(this).parents('li').addClass('highlight');
		});
		elements.blur(function() {
			$(this).parents('li').removeClass('highlight');
		});

		$("#brandform").validate({
			rules:{
				general_file:{
					required:true,
				},


			},
			messages:{
				general_file:'Please add image title',

			}
		});
	});

	jQuery('.select2class').select2({
            width: "100%",
            tag: true
    });
</script>
@endsection
