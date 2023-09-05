<?php
/*------------------------------------*/
/*user */
Route::get('user/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/index',
    'as' => 'admin.user.index',
    'uses' => 'UserController@index'
]);

Route::get('user/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/create',
    'as' => 'admin.user.create',
    'uses' => 'UserController@create'
]);

Route::get('user/search', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/search',
    'as' => 'admin.user.search',
    'uses' => 'UserController@search'
]);

Route::post('user/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/store',
    'as' => 'admin.user.store',
    'uses' => 'UserController@store'
]);

Route::get('user/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/show/{id}',
    'as' => 'admin.user.show',
    'uses' => 'UserController@show'
]);
Route::get('user/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/edit/{id}',
    'as' => 'admin.user.edit',
    'uses' => 'UserController@edit'
]);

Route::patch('user/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/update/{id}',
    'as' => 'admin.user.update',
    'uses' => 'UserController@update'
]);

Route::get('user/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/user/destroy/{id}',
    'as' => 'admin.user.destroy',
    'uses' => 'UserController@destroy'
]);

