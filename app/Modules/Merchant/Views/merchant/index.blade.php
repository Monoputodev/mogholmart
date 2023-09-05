@extends('Web::layouts.master')
@section('body')


<div class="container">
    <div class="breadcumb-area">
        <!-- Breadcumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Merchant</li>
            </ol>
        </nav>
    </div>
</div>

    <div class="clever-catagory bg-img d-flex align-items-center justify-content-center p-3" style="background-image: url(frontend/img/bg-img/bg1.png);">
        <h3>
        	Anyone can sell on ZINISMART
        	<br/>
        	<span>Please follow 4 steps</span>
        </h3>        
    </div>

    <section class="top-teacher-area section-padding-50">
    	<div class="container">
    		<div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="row">
            			<div class="col-6">
            				<a href="{{ route('registration.merchant.corner') }}" class="btn clever-btn w-100">New marchant  registration</a>
            			</div>
            			<div class="col-6">
            				<a href="{{ route('login.merchant.corner') }}" class="btn clever-btn btn-bg-2 w-100">Sign in as a merchant</a>
            			</div>
                    </div>
                </div>
    		</div>
    	</div>
    </section>

    <section class="top-teacher-area section-padding-50" style="background-image: url(frontend/img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Our Steps</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-8 offset-md-2 col-12">
                    <div class="row">

                        <!-- Registration & login -->
                        <div class="col-12 col-md-6">
                            <div class="single-instructor d-flex align-items-center mb-30">
                                <div class="instructor-thumb">
                                    <img src="{{ asset('frontend/img/bg-img') }}/registration.png" alt="">
                                </div>
                                <div class="instructor-info">
                                    <h5>Registration & Login</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Agreement Sign -->
                        <div class="col-12 col-md-6">
                            <div class="single-instructor d-flex align-items-center mb-30">
                                <div class="instructor-thumb">
                                    <img src=" {{ asset('frontend/img/bg-img') }}/agreement.png" alt="">
                                </div>
                                <div class="instructor-info">
                                    <h5>Agreement Sign</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Product in zinismart -->
                        <div class="col-12 col-md-6">
                            <div class="single-instructor d-flex align-items-center mb-30">
                                <div class="instructor-thumb">
                                    <img src="{{ asset('frontend/img/bg-img') }}/product.png" alt="">
                                </div>
                                <div class="instructor-info">
                                    <h5>Product Add in ZINISMART</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Earn Money -->
                        <div class="col-12 col-md-6">
                            <div class="single-instructor d-flex align-items-center mb-30">
                                <div class="instructor-thumb">
                                    <img src=" {{ asset('frontend/img/bg-img') }}/money.png" alt="">
                                </div>
                                <div class="instructor-info">
                                    <h5>Earn Money</h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="top-teacher-area section-padding-50-0">
    	<div class="container">
    		<div class="row">
    			<div class="col-12">
	    			<div class="section-heading">
	                    <h3>Go ahead your business with ZINISMART</h3>
	                </div>
	            </div>
    		</div>
    	</div>
    </section>

@endsection