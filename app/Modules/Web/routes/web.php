<?php

use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}

Route::group(['module' => 'Web', 'middleware' => ['web'], 'namespace' => 'App\Modules\Web\Controllers'], function() {

     Route::get('/', 'WebController@index'); #Main web route link

     include('basic_route.php');    #For Static information route with Homepage product
     include('category_route.php'); #Category/Subcategory page route
     include('product_route.php');  #Product Details Route
     include('customer_route.php'); #Customer Route (With Authentication)
     include('cart_route.php'); #Add Ro Cart Route
     include('brand_route.php'); #Add Ro Cart Route

     Route::post('product-load-more', 'WebController@loadmoreIndex');
});
