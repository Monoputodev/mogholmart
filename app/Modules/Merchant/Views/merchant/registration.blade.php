@extends('Web::layouts.master')
@section('body')

<div class="container">
    
<div class="breadcumb-area">
        <!-- Breadcumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('merchant.corner') }}">Merchant Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Merchant Registration</li>
            </ol>
        </nav>
    </div>

</div>
    <div class="clever-catagory bg-img d-flex align-items-center justify-content-center p-3" style="background-image: url({{ asset('frontend/img/bg-img/bg1.png') }});">
        <h3>
            Welcome to ZINISMART
            <br/>
            <span>Please filled up all required fields to complete registration</span>
        </h3>       
    </div>

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-md-center">
                
                <!-- Contact Form -->
                <div class="col col-lg-8">
                    <div class="contact-form">
                        <h4 class="text-center">Sign Up Form</h4>
                        

                        <?php
								$url = route('merchant.do_registration');
							?>
							{!! Form::open(array('url' => $url, 'method' => 'post', 'id' => "merchant_reg_id", 'class' => '')) !!}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                      {!! Form::text('shop_name',Input::old('shop_name'),['id'=>'shop_name', 'class' => 'form-control inputfield','placeholder'=>'Shop Name', 'required']) !!}

											<span class="errors">
												{!! $errors->first('shop_name') !!}
											</span>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::email('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield','placeholder'=>'Email *', 'required']) !!}
											
											<span class="errors">
												{!! $errors->first('email') !!}
											</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::number('mobile_no',Input::old('mobile_no'),['id'=>'mobile_no', 'class' => 'form-control inputfield','placeholder'=>'Mobile Number', 'required']) !!}
											<span class="errors">
												{!! $errors->first('mobile_no') !!}
											</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                    	{{ Form::password('password', array('placeholder'=>'Password', 'id'=>'password', 'class'=>'form-control inputfield', 'required' ) ) }}
                                    	<span class="errors">
                                    		{!! $errors->first('password') !!}
                                    	</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::password('password_confirmation', array('placeholder'=>'Confirm Password', 'id'=>'password_confirmation', 'class'=>'form-control inputfield', 'required' ) ) }}

                                        <span class="errors">
                                            {!! $errors->first('password_confirmation') !!}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    	{!! Form::textarea('shop_address',Input::old('shop_address'),['id'=>'shop_address','class' => 'form-control textarea', 'placeholder'=>'Enter Address','rows'=>'3', 'cols'=>'50']) !!}

                                    	<span class="errors">
                                    		{!! $errors->first('shop_address') !!}
                                    	</span>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn clever-btn w-100">Sign up</button>
                                </div>
                            </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection