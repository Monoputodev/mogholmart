<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::group(['module' => 'Merchant', 'middleware' => ['web'], 'namespace' => 'App\Modules\Merchant\Controllers'], function() {
    include('merchant_route.php');
});

Route::group(['prefix' => config('global.prefix_name'),'module' => 'Merchant', 'middleware' => ['web','adminmiddleware'], 'namespace' => 'App\Modules\Merchant\Controllers'], function() {

   include('admin_merchant_route.php');
});
