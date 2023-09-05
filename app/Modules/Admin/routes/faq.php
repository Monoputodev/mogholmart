<?php

/*------------------------------------*/
/*faq */
Route::get('faq/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/index',
    'as' => 'admin.faq.index',
    'uses' => 'FaqController@index'
]);

Route::get('faq/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/create',
    'as' => 'admin.faq.create',
    'uses' => 'FaqController@create'
]);
Route::get('faq/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.faq.search',
    'uses' => 'FaqController@search'
]);

Route::post('faq/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/store',
    'as' => 'admin.faq.store',
    'uses' => 'FaqController@store'
]);
Route::get('faq/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/show/{id}',
    'as' => 'admin.faq.show',
    'uses' => 'FaqController@show'
]);
Route::get('faq/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/edit/{id}',
    'as' => 'admin.faq.edit',
    'uses' => 'FaqController@edit'
]);


Route::patch('faq/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/update/{id}',
    'as' => 'admin.faq.update',
    'uses' => 'FaqController@update'
]);
Route::get('faq/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/faq/destroy/{id}',
    'as' => 'admin.faq.destroy',
    'uses' => 'FaqController@destroy'
]);