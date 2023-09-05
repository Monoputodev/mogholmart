<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::group(['module' => 'Discount', 'middleware' => ['web'], 'namespace' => 'App\Modules\Discount\Controllers'], function() {

    //Route::resource('Discount', 'DiscountController');

     include('discount_route.php');

});
