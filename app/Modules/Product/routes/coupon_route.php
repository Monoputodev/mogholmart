<?php

/*/-----------------------------------*/
/*brand */
Route::get('coupon/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/index',
    'as' => 'admin.coupon.index',
    'uses' => 'CouponController@index'
]);

Route::get('coupon/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/create',
    'as' => 'admin.coupon.create',
    'uses' => 'CouponController@create'
]);


Route::get('coupon/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.coupon.search',
    'uses' => 'CouponController@search'
]);

Route::post('coupon/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/store',
    'as' => 'admin.coupon.store',
    'uses' => 'CouponController@store'
]);

Route::get('coupon/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/show/{id}',
    'as' => 'admin.coupon.show',
    'uses' => 'CouponController@show'
]);
Route::get('coupon/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/edit/{id}',
    'as' => 'admin.coupon.edit',
    'uses' => 'CouponController@edit'
]);


Route::patch('coupon/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/update/{id}',
    'as' => 'admin.coupon.update',
    'uses' => 'CouponController@update'
]);
Route::get('coupon/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/coupon/destroy/{id}',
    'as' => 'admin.coupon.destroy',
    'uses' => 'CouponController@destroy'
]);