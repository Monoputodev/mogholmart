<?php

/*------------------------------------*/
/*hub */
Route::get('admin-emi-index', [
    'as' => 'admin.emi.index',
    'uses' => 'EMIController@index'
]);

Route::get('admin-emi-search', [
    'as' => 'admin.emi.search',
    'uses' => 'EMIController@search'
]);

Route::get('admin-emi-create', [
    'as' => 'admin.emi.create',
    'uses' => 'EMIController@create'
]);

Route::post('admin-emi-store', [
    'as' => 'admin.emi.store',
    'uses' => 'EMIController@store'
]);
Route::get('admin-emi-show/{id}', [
    'as' => 'admin.emi.show',
    'uses' => 'EMIController@show'
]);
Route::get('admin-emi-edit/{id}', [
    'as' => 'admin.emi.edit',
    'uses' => 'EMIController@edit'
]);

Route::patch('admin-emi-update/{id}', [
    'as' => 'admin.emi.update',
    'uses' => 'EMIController@update'
]);

Route::get('admin-emi-destroy/{id}', [
    'as' => 'admin.emi.destroy',
    'uses' => 'EMIController@destroy'
]);