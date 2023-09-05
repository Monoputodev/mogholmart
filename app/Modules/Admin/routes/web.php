<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}

Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {
	
	Route::get('login','Auth\LoginController@index');

	Route::post('do_login','Auth\LoginController@post_login');

	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['prefix' => config('global.prefix_name'),'module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {

	Route::get('dashboard', 'AdminController@index');
});

Route::group(['prefix' => config('global.prefix_name'),'module' => 'Admin', 'middleware' => ['web','redirect_if_logout','adminmiddleware'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {

	include('settings_route.php');
	include('advertisement_route.php');	
	include('slider_route.php');	
	include('faq.php');	
	include('testimonial_route.php');	
	include('menu_route.php');
	include('generalpages_route.php');

});
