<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
?>


<div class="row">

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>New Password</label>
				{!! Form::text('new_password',Input::old('new_password'),['id'=>'new_password', 'class'=>'form-control', 'placeholder'=>'Enter your new password', 'required'=> 'required']) !!}
				{!! $errors->first('new_password') !!}
			</div>
		</div>
	</div>

	<div class="col-md-12 pr-0">
		<div class="form-group">

			<div class="form-line">
				<label>Retype Password</label>
				{!! Form::text('retype_password',Input::old('retype_password'),['id'=>'retype_password', 'class'=>'form-control ','placeholder'=>'Retype your password' ,'required'=> 'required']) !!}
				{!! $errors->first('retype_password') !!}
			</div>
		</div>
	</div>

	<div class="col-md-12">

		{!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right btn-sm font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;

	</div>
</div>
<script>

	var elements = $("input[type!='submit'], textarea, select");
	elements.focus(function() {
		$(this).parents('li').addClass('highlight');
	});
	elements.blur(function() {
		$(this).parents('li').removeClass('highlight');
	});

	$("#change_password").validate({
		rules:{

			new_password:{
				required:true,
				minlength:6,
				maxlength:20
			},
			retype_password:{
				required:true,
				equalTo: '#new_password',
			},
		},
		messages:{

			new_password: 'Plese enter new password',
			retype_password: 'Plese retype your password',

		}
	});

</script>