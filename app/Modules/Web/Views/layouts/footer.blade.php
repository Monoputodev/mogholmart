
<div class="modal fade open_modal_update" tabindex="" role="dialog">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">



			</div> <!-- / .modal-body -->
		</div> <!-- / .modal-content -->
	</div>
</div>

<div class="modal fade" id="popupTopbar"  tabindex="" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<ul style="margin-top: 24px;
				letter-spacing: 1px;
				font-size: 16px;
				cursor: pointer;">
				<li><i class="ti-headphone-alt"></i> {{config('global.MOBILE_NO')}}</li>
				<li><i class="ti-email"></i> {{config('global.EMAIL_NAME')}}</li>
				@if(Auth::user())

				<li><i class="ti-user"></i> <a href="{{route('customer.dashboard')}}">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a></li>

				<li>
					<a href="{{route('customer.logout')}}"><i class="ti-lock"></i> Logout</a>
				</li>
				@else
				<li>
					<a href="{{route('web.customer.account')}}"><i class="ti-user"></i> My Account</a>
				</li>
				@endif

				<li><i class="ti-power-off"></i> <a href="{{route('web.customer.register')}}">Sign Up</a></li>

			</ul>


		</div> <!-- / .modal-body -->
	</div> <!-- / .modal-content -->
</div>
</div>



<div class="modal fade in wishlist_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title"> Save For Later</h4>
			</div>
			<div class="modal-body">
				<strong class="modal-message" ></strong>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade quick_view_modal" id="exampleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
				</div>
			</div>
		</div>
	</div>
</div>


<footer class="footer">
	<!-- Footer Top -->
	<div class="footer-top section">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer about">
						<div class="logo">
							<a href="{{ URL::to('/') }}"><h4>{{config('app.name')}}</h4></a>
						</div>
						<p class="text">
							@if(Session::has('about'))
							<?php   $about_site= Session::get('about'); ?>
							{{ $about_site->value }}
							@endif


						</p>
						<p class="call">Got Question? Call us 24/7<span>
							<a href="tel:{{config('global.MOBILE_NO')}}">{{config('global.MOBILE_NO')}}</a></span>
						</p>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer links">
						<h4>Information</h4>
						<ul>
							<li><a href="{{ route('web.about.us') }}">About Us</a></li>
							<li><a href="{{ route('web.faq') }}">Faq</a></li>
							<li><a href="{{ route('web.terms.condition') }}">Terms & Conditions</a></li>
							<li><a href="{{ route('web.contact.us') }}">Contact Us</a></li>
							<li><a href="{{route('web.support')}}">Help & Support</a></li>
						</ul>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-2 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer links">
						<h4>Customer Service</h4>
						<ul>
							<li><a href="#">Payment Methods</a></li>
							<li><a href="#">Money-back</a></li>
							<li><a href="{{ route('web.return.refund') }}">Returns</a></li>
							<li><a href="{{ route('web.shopping.guide') }}">Shopping Guide</a></li>
							<li><a href="{{ route('web.privacy.ploicy') }}">Privacy Policy</a></li>
						</ul>
					</div>
					<!-- End Single Widget -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Single Widget -->
					<div class="single-footer social">
						<h4>Get In Tuch</h4>
						<!-- Single Widget -->
						<div class="contact">
							<ul>
								<li>{{config('global.OFFICE_ADDRESS')}}</li>

								<li>{{config('global.EMAIL_NAME')}}</li>

							</ul>
						</div>
						<!-- End Single Widget -->



						<ul>
						<li><a href="https://www.facebook.com/priyolink" target="__blank"><i id="footerIcon" class="ti-facebook "></i></a></li>
							<li><a href="#"><i id="footerIcon" class="ti-twitter"></i></a></li>
							<li><a href="#"><i id="footerIcon" class="ti-flickr"></i></a></li>
							<li><a href="#"><i id="footerIcon" class="ti-instagram"></i></a></li>
						</ul>
					</div>
					<!-- End Single Widget -->
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">

			<div class="col-lg-12 col-xs-12 payment-w">
				<img src="{{URL::to('/logo/ssladd.png')}}" alt="payment" style="border-radius:5px">
			</div>
		</div>
	</div>
	<!-- End Footer Top -->
	<div class="copyright">
		<div class="container">
			<div class="inner">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="left">
							<p>Copyright © 2023 <a href="#" target="_blank">{{config('app.name')}}</a>  -  All Rights Reserved.</p>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="right">
							<p>Developed by <a href="https://www.monoputo.com" target="_blank">Monoputo.com</a>  </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>





