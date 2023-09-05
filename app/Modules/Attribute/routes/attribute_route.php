<?php

/*------------------------------------*/
/*attribute */
Route::get('attribute/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/index',
    'as' => 'admin.attribute.index',
    'uses' => 'AttributeController@index'
]);

Route::get('attribute/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/create',
    'as' => 'admin.attribute.create',
    'uses' => 'AttributeController@create'
]);
Route::get('attribute/search', [
   'middleware' => 'strim_empty_parem',
    'as' => 'admin.attribute.search',
    'uses' => 'AttributeController@search'
]);

Route::post('attribute/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/store',
    'as' => 'admin.attribute.store',
    'uses' => 'AttributeController@store'
]);

Route::post('attribute/option/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/option/store',
    'as' => 'admin.attribute.option.store',
    'uses' => 'AttributeController@store_option'
]);

Route::get('attribute/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/show/{id}',
    'as' => 'admin.attribute.show',
    'uses' => 'AttributeController@show'
]);
Route::get('attribute/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/edit/{id}',
    'as' => 'admin.attribute.edit',
    'uses' => 'AttributeController@edit'
]);
Route::get('attribute/option/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/option/edit/{id}',
    'as' => 'admin.attribute.option.edit',
    'uses' => 'AttributeController@edit_option'
]);

Route::get('attribute/option/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/option/{id}',
    'as' => 'admin.attribute.option',
    'uses' => 'AttributeController@attr_option'
]);

Route::patch('attribute/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/update/{id}',
    'as' => 'admin.attribute.update',
    'uses' => 'AttributeController@update'
]);

Route::patch('attribute/option/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/option/update/{id}',
    'as' => 'admin.attribute.option.update',
    'uses' => 'AttributeController@update_option'
]);

Route::get('attribute/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/destroy/{id}',
    'as' => 'admin.attribute.destroy',
    'uses' => 'AttributeController@destroy'
]);

Route::get('attribute/option/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attribute/option/destroy/{id}',
    'as' => 'admin.attribute.option.destroy',
    'uses' => 'AttributeController@destroy_option'
]);