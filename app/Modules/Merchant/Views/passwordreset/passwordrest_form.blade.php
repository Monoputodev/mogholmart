@extends('Merchant::merchant.merchant_master')
@section('body')



    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-md-center">
                
                <!-- Contact Form -->
                <div class="col col-lg-8">
                    <div class="contact-form">
                        <h4 class="text-center">Password Reset Form</h4>
                        

                   			<?php
								$url = route('merchant.password.reset');
							?>

							{!! Form::open(array('url' => $url, 'method' => 'post', 'id' => "customerpass")) !!}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                    	
                                    	{!! Form::password('password',['id'=>'password', 'class' => 'form-control','placeholder'=>'New password', 'required']) !!}
                                    	<input type="hidden" name="dataemail" id="dataemail" value="{{$data->id}}">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                    	
                                    	{!! Form::password('password_confirmation',['id'=>'password_confirmation', 'class' => 'form-control','placeholder'=>'Confirm new password', 'required']) !!}
                                    </div>
                                </div>

                                
                                
                                <div class="col-12">
                                    <button type="submit" class="btn clever-btn w-100">Reset Password</button>
                                </div>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
	$(function() {
		// highlight
		var elements = $("input[type!='submit'], textarea, select");
		elements.focus(function() {
			$(this).parents('li').addClass('highlight');
		});
		elements.blur(function() {
			$(this).parents('li').removeClass('highlight');
		});

        $("#customerpass").validate({
            rules:{
                
         
                password:{
                    required:true,
                    minlength:6,
                    maxlength:20
                },
                password_confirmation:{
                    required:true,
                    equalTo: '#password',
                },
                
            },
            messages:{
                password:'Please enter new password',
                password_confirmation: 'Plese retype password',
            }
        });
});
</script>
@endsection