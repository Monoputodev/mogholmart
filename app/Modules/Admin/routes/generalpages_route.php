<?php

/*/-----------------------------------*/
/*generalpages */
Route::get('generalpages/index', [
    'as' => 'admin.generalpages.index',
    'uses' => 'GeneralPagesController@index'
]);

Route::get('generalpages/create', [
    'as' => 'admin.generalpages.create',
    'uses' => 'GeneralPagesController@create'
]);
Route::get('generalpages/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.generalpages.search',
    'uses' => 'GeneralPagesController@search'
]);

Route::post('generalpages/store', [
    'as' => 'admin.generalpages.store',
    'uses' => 'GeneralPagesController@store'
]);
Route::get('generalpages/show/{id}', [
    'as' => 'admin.generalpages.show',
    'uses' => 'GeneralPagesController@show'
]);
Route::get('generalpages/edit/{id}', [
    'as' => 'admin.generalpages.edit',
    'uses' => 'GeneralPagesController@edit'
]);


Route::patch('generalpages/update/{id}', [
    'as' => 'admin.generalpages.update',
    'uses' => 'GeneralPagesController@update'
]);
Route::get('generalpages/destroy/{id}', [
    'as' => 'admin.generalpages.destroy',
    'uses' => 'GeneralPagesController@destroy'
]);