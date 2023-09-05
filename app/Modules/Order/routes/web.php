<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::group(['prefix'=>config('global.prefix_name'),'module' => 'Order', 'middleware' => ['web','adminmiddleware','redirect_if_logout'], 'namespace' => 'App\Modules\Order\Controllers'], function() {

    //Route::resource('Order', 'OrderController');

	include('order_route.php');
	include('neworder_route.php');
	include('merchant_order_route.php');

	Route::any('medicine/order/index', [
		'as' => 'admin.medicine.index',
		'uses' => 'OrderController@medicineIndex'
	]);

	Route::get('medicine/order/view/{id}', [
		'as' => 'admin.medicine.view',
		'uses' => 'OrderController@medicineview'
	]);

});
