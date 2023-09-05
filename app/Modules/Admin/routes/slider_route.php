<?php

/*------------------------------------*/
/*slider */
Route::get('slider/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/index',
    'as' => 'admin.slider.index',
    'uses' => 'SliderController@index'
]);

Route::get('slider/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/create',
    'as' => 'admin.slider.create',
    'uses' => 'SliderController@create'
]);
Route::get('slider/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.slider.search',
    'uses' => 'SliderController@search'
]);

Route::post('slider/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/menu/index',
    'as' => 'admin.slider.store',
    'uses' => 'SliderController@store'
]);
Route::get('slider/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/show/{id}',
    'as' => 'admin.slider.show',
    'uses' => 'SliderController@show'
]);
Route::get('slider/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/edit/{id}',
    'as' => 'admin.slider.edit',
    'uses' => 'SliderController@edit'
]);

Route::patch('slider/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/update/{id}',
    'as' => 'admin.slider.update',
    'uses' => 'SliderController@update'
]);
Route::get('slider/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/slider/destroy/{id}',
    'as' => 'admin.slider.destroy',
    'uses' => 'SliderController@destroy'
]);