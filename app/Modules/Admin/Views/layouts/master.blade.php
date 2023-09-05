
<html lang="{{App::getLocale()}}">
<head>
	<meta charset="utf-8"/>
	<title>{{ config('app.name', 'Xotil.com') }} | {{isset($pageTitle)?$pageTitle:''}}</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	@if(Session::has('shortcut_icon'))
	<?php  $shortcut_icon = Session::get('shortcut_icon'); ?>
	<link rel="shortcut icon" href="{{URL::to('uploads/generel_file/')}}/{{$shortcut_icon->value}}"/>
	@endif
	
	@include('Admin::layouts.css')
	@include('Admin::layouts.js')
	

</head>
<body class="theme-red">
	<!-- Page Loader -->
	<div class="page-loader-wrapper" id="page-loader-wrapper">
		<div class="loader">
			<div class="preloader">
				<div class="spinner-layer pl-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
			<p>Please wait...</p>
		</div>
	</div>
<!-- #END# Page Loader -->

<!-- Top Bar -->
<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
			data-target="#navbar-collapse" aria-expanded="false"></a>
			<a href="javascript:void(0);" class="bars"></a>
			<a class="navbar-brand" style="margin-top: -5px; height:50px" href="{{URL::to(config('global.prefix_name').'/dashboard')}}">
				ADMIN:: DASHBOARD
			</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown pull-left">
					<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
						<i class="material-icons">notifications</i>
						<span class="label-count">
							@if(Session::has('total_pending_order'))
							<?php  $total_pending_order = Session::get('total_pending_order'); ?>
							<?=isset($total_pending_order)?$total_pending_order:'0'?>
							@endif
							</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">PENDING ORDER'S</li>
						<li class="body">
							<ul class="menu">
								@if(Session::has('pending_order'))
							<?php  $pending_order = Session::get('pending_order'); ?>
								@if (isset($pending_order) && count($pending_order)>0)
								@foreach ($pending_order as $data)

								<li>
									<a href="{{ route('admin.order.show', $data->id) }}">
										<div class="icon-circle bg-cyan">
											<i class="material-icons">add_shopping_cart</i>
										</div>
										<div class="menu-info">
											<h4>{{$data->order_number}}</h4>
											<p>
												<i class="material-icons">access_time</i> {{ date('M d, Y',strtotime($data->date)) }}
											</p>
										</div>
									</a>
								</li>
								@endforeach
								@endif
								@endif


							</ul>
						</li>
						<li class="footer">
							<a href="{{ route('all.pending.order') }}">View All Pending Order's</a>
						</li>
					</ul>
				</li>
				<li>   
					<a type="button"  target="__blank" href="{{URL::to('/')}}" class="btn btn-info" onclick="return confirm('Are you sure to go home page ?')" style="margin-top: 10px;height: 40px;background: #f44336;">
						<i class="material-icons">home</i>
						<span>{{__('messages.VisitSite')}}</span>
					</a>
				</li>
				
				<li><a type="button" href="{{ route('logout') }}" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();" class="btn btn-danger"
				style="margin-top: 10px;height: 40px;background: #f44336;">
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
				<i class="material-icons">input</i><span>{{__('messages.Logout')}}</span></a>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- #Top Bar -->
<section>
	@include('Admin::layouts.nav')
</section>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			@include('Admin::error.msg')
			@yield('body')
		</div>
	</div>
</section>
<!-- end page container -->

@include('Admin::layouts.footer_js')
</body>
</html>


