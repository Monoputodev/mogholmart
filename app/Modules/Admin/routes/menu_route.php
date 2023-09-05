<?php

/*------------------------------------*/
/*menu */
Route::get('menu/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/index',
    'as' => 'admin.menu.index',
    'uses' => 'MenuController@index'
]);

Route::get('menu/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/create',
    'as' => 'admin.menu.create',
    'uses' => 'MenuController@create'
]);
Route::get('menu/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.menu.search',
    'uses' => 'MenuController@search'
]);

Route::post('menu/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/store',
    'as' => 'admin.menu.store',
    'uses' => 'MenuController@store'
]);
Route::get('menu/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/show/{id}',
    'as' => 'admin.menu.show',
    'uses' => 'MenuController@show'
]);
Route::get('menu/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/edit/{id}',
    'as' => 'admin.menu.edit',
    'uses' => 'MenuController@edit'
]);


Route::patch('menu/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/update/{id}',
    'as' => 'admin.menu.update',
    'uses' => 'MenuController@update'
]);
Route::get('menu/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/destroy/{id}',
    'as' => 'admin.menu.destroy',
    'uses' => 'MenuController@destroy'
]);