<?php

/*------------------------------------*/
/*attributeset */
Route::get('attributeSet/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/index',
    'as' => 'admin.attribute.set.index',
    'uses' => 'AttributesetController@index'
]);

Route::get('attributeSet/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/create',
    'as' => 'admin.attribute.set.create',
    'uses' => 'AttributesetController@create'
]);
Route::get('attributeSet/search', [
 'middleware' => 'strim_empty_parem',
 'as' => 'admin.attribute.set.search',
 'uses' => 'AttributesetController@search'
]);

Route::post('attributeSet/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/store',
    'as' => 'admin.attribute.set.store',
    'uses' => 'AttributesetController@store'
]);

Route::get('attributeSet/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/show/{id}',
    'as' => 'admin.attribute.set.show',
    'uses' => 'AttributesetController@show'
]);
Route::get('attributeSet/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/edit/{id}',
    'as' => 'admin.attribute.set.edit',
    'uses' => 'AttributesetController@edit'
]);


Route::patch('attributeSet/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/update/{id}',
    'as' => 'admin.attribute.set.update',
    'uses' => 'AttributesetController@update'
]);
Route::get('attributeSet/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/destroy/{id}',
    'as' => 'admin.attribute.set.destroy',
    'uses' => 'AttributesetController@destroy'
]);