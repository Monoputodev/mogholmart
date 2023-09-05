<?php

/*//----------------------------------*/
/*brand */
Route::get('brand/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/index',
    'as' => 'admin.brand.index',
    'uses' => 'BrandController@index'
]);

Route::get('brand/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/create',
    'as' => 'admin.brand.create',
    'uses' => 'BrandController@create'
]);


Route::get('brand/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.brand.search',
    'uses' => 'BrandController@search'
]);

Route::post('brand/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/store',
    'as' => 'admin.brand.store',
    'uses' => 'BrandController@store'
]);

Route::get('brand/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/show/{id}',
    'as' => 'admin.brand.show',
    'uses' => 'BrandController@show'
]);
Route::get('brand/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/edit/{id}',
    'as' => 'admin.brand.edit',
    'uses' => 'BrandController@edit'
]);


Route::patch('brand/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/update/{id}',
    'as' => 'admin.brand.update',
    'uses' => 'BrandController@update'
]);
Route::get('brand/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/brand/destroy/{id}',
    'as' => 'admin.brand.destroy',
    'uses' => 'BrandController@destroy'
]);