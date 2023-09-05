<?php

/*------------------------------------*/
/*advertisement */
Route::get('advertisement/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/index',
    'as' => 'admin.advertisement.index',
    'uses' => 'AdvertisementController@index'
]);

Route::get('advertisement/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/create',
    'as' => 'admin.advertisement.create',
    'uses' => 'AdvertisementController@create'
]);
Route::get('advertisement/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.advertisement.search',
    'uses' => 'AdvertisementController@search'
]);

Route::post('advertisement/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/store',
    'as' => 'admin.advertisement.store',
    'uses' => 'AdvertisementController@store'
]);
Route::get('advertisement/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/show/{id}',
    'as' => 'admin.advertisement.show',
    'uses' => 'AdvertisementController@show'
]);
Route::get('advertisement/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/edit/{id}',
    'as' => 'admin.advertisement.edit',
    'uses' => 'AdvertisementController@edit'
]);


Route::patch('advertisement/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/update/{id}',
    'as' => 'admin.advertisement.update',
    'uses' => 'AdvertisementController@update'
]);
Route::get('advertisement/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/advertisement/destroy/{id}',
    'as' => 'admin.advertisement.destroy',
    'uses' => 'AdvertisementController@destroy'
]);