@extends('Web::layouts.master')
@section('body')

<div class="container">
    <div class="breadcumb-area">
        <!-- Breadcumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('merchant.corner') }}">Merchant Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Merchant Reset Password</li>
            </ol>
        </nav>
    </div>
</div>

    <div class="clever-catagory bg-img d-flex align-items-center justify-content-center p-3" style="background-image: url({{ asset('frontend/img/bg-img/bg1.jpg') }});">
        <h3>
            Welcome to ZINISMART
            <br/>
            <span>Please put your valid information to reset your password</span>
        </h3>       
    </div>

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-md-center">
                
                <!-- Contact Form -->
                <div class="col col-lg-10">
                    <div class="contact-form">
                        <h4 class="text-center">Forget Password Form</h4>
                        
                        <?php $url = route('merchant.forgetpassword.sendmail'); ?>
							{!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "login-formas" ,'id'=>'forgetpass')) !!}
                         	<div class="row">
                                <div class="col-12 col-lg-8">
                                	<div class="col-12">
                                            <div class="form-group">
                                                {!! Form::email('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield required email','placeholder'=>'zinismart@gmail.com', 'required']) !!}
												<span class="errors">
													{!! $errors->first('email') !!}
												</span>				 
                                            </div>
                                        </div> 
                                </div>
								<div class="col-12 col-lg-1">

                                        <div class="col-12">
                                            <button class="btn clever-btn btn-bg-2 w-100">Send Mail</button>
                                        </div>
                                   
                                </div>
						    </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection