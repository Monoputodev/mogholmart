@extends('Web::layouts.master')

@section('body')

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="{{ URL::to('/') }}">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="contact-us" class="contact-us section">
	<div class="container">
		<div class="contact-head">
			<div class="row">
				<div class="col-lg-8 col-12">
					<div class="form-main">
						<div class="title">
							<h4>Get in touch</h4>
							<h3>Write us a message</h3>
						</div>
						<?php
						$url = route('contact.mail.submit');
						?>
						{!! Form::open(array('url' => $url, 'method' => 'post', 'id' => "", 'class' =>'form')) !!}
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Your Name<span>*</span></label>
									<input name="name" type="text" placeholder="" required="">
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Your Subjects<span>*</span></label>
									<input name="subject" type="text" placeholder="" required="">
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Your Email<span>*</span></label>
									<input name="email" type="email" placeholder="" required="">
								</div>	
							</div>
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Your Phone<span>*</span></label>
									<input name="phone" type="text" placeholder="" required="">
								</div>	
							</div>
							<div class="col-12">
								<div class="form-group message">
									<label>your message<span>*</span></label>
									<textarea name="message" placeholder="" required=""></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group button">
									<button type="submit" class="btn btn-info">Send Message</button>
								</div>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="col-lg-4 col-12">
					<div class="single-head">
						<div class="single-info">
							<i class="fa fa-phone"></i>
							<h4 class="title">Call us Now:</h4>
							<ul>
								<li>{{config('global.MOBILE_NO')}}</li>
							</ul>
						</div>
						
						<div class="single-info">
							<i class="fa fa-location-arrow"></i>
							<h4 class="title">Our Address:</h4>
							<ul>
								<li>
									{{config('global.OFFICE_ADDRESS')}}.
									{{config('global.EMAIL_NAME')}}
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
	<div class="container">
		<div class="inner-top">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-12">
					<!-- Start Newsletter Inner -->
					<div class="inner">
						<h4>Newsletter</h4>
						<p> Subscribe to our newsletter for more update !</p>

						<div class="newsletter-inner">

							<input name="EMAIL" placeholder="Your email address" required="" id="txtemail" type="email">
							<button type="button" class="btn" id="subscription">Subscribe</button>
						</div>

					</div>
					<!-- End Newsletter Inner -->
				</div>
			</div>
		</div>
	</div>
</section>
@endsection