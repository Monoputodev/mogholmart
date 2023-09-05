<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::group(['prefix' => config('global.prefix_name'),'module' => 'Product', 'middleware' => ['web','adminmiddleware'], 'namespace' => 'App\Modules\Product\Controllers'], function() {

 
   include('manufacture_route.php');
   include('brand_route.php');
   include('product_route.php');
  // include('shipping_calculation_setting_route.php');
   include('customer_product_review_route.php');
   include('inventory_route.php');
   include('coupon_route.php');
   include('price.php');
   //Route::get('pq','ProductController@product_item_change');

});
