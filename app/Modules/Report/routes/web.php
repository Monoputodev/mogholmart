<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}
Route::group(['prefix'=>config('global.prefix_name'),'module' => 'Report', 'middleware' => ['web','adminmiddleware','redirect_if_logout'], 'namespace' => 'App\Modules\Report\Controllers'], function() {

    //Route::resource('Report', 'ReportController');
	include('orderreport.php');
	include('productreport.php');
	include('salesreport.php');
	include('collectionreport.php');

});
