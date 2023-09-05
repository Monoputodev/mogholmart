@extends('Web::layouts.master')
@section('body')

<div class="container">
    
<div class="breadcumb-area">
        <!-- Breadcumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('merchant.corner') }}">Merchant Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Merchant Login</li>
            </ol>
        </nav>
    </div>

</div>
    <div class="clever-catagory bg-img d-flex align-items-center justify-content-center p-3" style="background-image: url({{URL::to('/')}}/frontend/img/bg-img/bg1.png);">
        <h3>
            Welcome to ZINISMART
            <br/>
            <span>Please put your valid information to sign in</span>
        </h3>       
    </div>

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row justify-content-md-center">
                
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="contact-form">
                        <h4 class="text-center">Merchant Sign In Form</h4>
                        
                        <?php $url = route('merchant.post.login'); ?>
                            {!! Form::open(array('url' => $url, 'method' => 'post', 'class' => "login-formas", 'id'=>'loginform')) !!}
                            <div class="row">

                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                {!! Form::email('email',Input::old('email'),['id'=>'email', 'class' => 'form-control inputfield required email','placeholder'=>'zinismart@gmail.com', 'required']) !!}
                                                <span class="errors">
                                                    {!! $errors->first('email') !!}
                                                </span> 
                                            </div>
                                        </div>                                
                                       
                                        <div class="col-12">
                                            <div class="form-group">
                                                {{ Form::password('password', array('placeholder'=>'Password', 'class'=>'form-control inputfield', 'placeholder'=>'Password', 'required' ) ) }}                                         
                                                <span class="errors">
                                                    {!! $errors->first('password') !!}
                                                </span>
                                            </div>
                                        </div> 

                                        <div class="col-12">
                                            <div class="form-group">
                                                <a class="pull-right mb-10" href="{{ route('merchant.forgetpassword') }}">Forgot Password ?</a>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <button class="btn clever-btn btn-bg-2 w-100">Sign in</button>
                                        </div>

                                    </div>
                                    
                                    

                                </div>

                                <!-- <div class="col-12 col-lg-6">
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn clever-btn btn-bg-facebook w-100 mb-10 ">
                                                <i class="fa fa-facebook" aria-hidden="true"></i> Sign up or login with
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center mb-10 mt-10">Or, login with</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn clever-btn btn-bg-google w-100">
                                                <i class="fa fa-google" aria-hidden="true"></i> Google
                                            </button>
                                        </div>
                                
                                    </div>
                                
                                </div> -->
                            </div>
                            
                         {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection