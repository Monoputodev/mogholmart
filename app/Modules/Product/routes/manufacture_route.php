<?php

/*------------------------------------*/
/*manufacture */
Route::get('manufacture/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/index',
    'as' => 'admin.manufacture.index',
    'uses' => 'ManufactureController@index'
]);

Route::get('manufacture/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/create',
    'as' => 'admin.manufacture.create',
    'uses' => 'ManufactureController@create'
]);


Route::get('manufacture/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.manufacture.search',
    'uses' => 'ManufactureController@search'
]);

Route::post('manufacture/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/search',
    'as' => 'admin.manufacture.store',
    'uses' => 'ManufactureController@store'
]);

Route::get('manufacture/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/show/{id}',
    'as' => 'admin.manufacture.show',
    'uses' => 'ManufactureController@show'
]);
Route::get('manufacture/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/edit/{id}',
    'as' => 'admin.manufacture.edit',
    'uses' => 'ManufactureController@edit'
]);


Route::patch('manufacture/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/update/{id}',
    'as' => 'admin.manufacture.update',
    'uses' => 'ManufactureController@update'
]);
Route::get('manufacture/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/manufacture/destroy/{id}',
    'as' => 'admin.manufacture.destroy',
    'uses' => 'ManufactureController@destroy'
]);