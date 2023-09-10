<?php
if(Session::has('main_logo')){
	$main_logo = Session::get('main_logo');
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<title>{{config('app.name')}} | Online shopping at cheapest price in Bangladesh</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="{{env('APP_NAME')}}|  Online shopping at cheapest price in Bangladesh">
	<meta name="author" content="theLarasoft.com">
	<meta name="keywords" content="{{ env('APP_NAME') }} |  Online shopping at cheapest price in Bangladesh">
	<meta name="robots" content="all">
	<link rel="icon" type="image/png" href="{{ URL::to('uploads/generel_file') }}/{{ $main_logo->value }}">
	<meta property="og:url" content="{{config('global.DOMAIN_NAME')}}<?php  print $_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:type"         content="website">
	<meta property="og:title"        content="{{env('APP_NAME')}} |">
	<meta name="og:site_name" content="{{config('global.DOMAIN_NAME')}}"/>
	<meta property="og:description"  content=" Online shopping at cheapest price in Bangladesh">
	<meta property="og:image"        content="{{ URL::to('uploads/generel_file') }}/{{ $main_logo->value }}"/>
	<meta property="og:image:alt"    content="{{config('global.DOMAIN_NAME')}}"/>
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	@include('Web::layouts.css')

</head>
<body class="js">

	@include('Web::layouts.header')

	@include('Web::home.popup_cart')
	<div class="container" style="margin-top:10px">
	    @include('Web::pages.msg')
	</div>
	@yield('body')
	@include('Web::layouts.footer')

	@include('Web::layouts.js')
	@include('Web::layouts.javascript')


</body>
</html>
