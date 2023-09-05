<?php

/*------------------------------------*/
/*menu */
Route::get('comission/setting/index', [
    'as' => 'admin.comission.setting.index',
    'uses' => 'ComissionController@index'
]);

Route::get('comission/setting/create', [
    'as' => 'admin.comission.setting.create',
    'uses' => 'ComissionController@create'
]);
Route::get('comission/setting/search', [
    'as' => 'admin.comission.setting.search',
    'uses' => 'ComissionController@search'
]);

Route::post('comission/setting/store', [
    'as' => 'admin.comission.setting.store',
    'uses' => 'ComissionController@store'
]);
Route::get('comission/setting/show/{id}', [
    'as' => 'admin.comission.setting.show',
    'uses' => 'ComissionController@show'
]);
Route::get('comission/setting/edit/{id}', [
    'as' => 'admin.comission.setting.edit',
    'uses' => 'ComissionController@edit'
]);


Route::patch('comission/setting/update/{id}', [
    'as' => 'admin.comission.setting.update',
    'uses' => 'ComissionController@update'
]);
Route::get('comission/setting/destroy/{id}', [
    'as' => 'admin.comission.setting.destroy',
    'uses' => 'ComissionController@destroy'
]);