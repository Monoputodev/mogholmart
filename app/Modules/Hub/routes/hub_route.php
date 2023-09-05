<?php

/*------------------------------------*/
/*hub */
Route::get('admin-hub-index', [
    'as' => 'admin.hub.index',
    'uses' => 'HubController@index'
]);

Route::get('admin-hub-search', [
    'as' => 'admin.hub.search',
    'uses' => 'HubController@search'
]);

Route::get('admin-hub-create', [
    'as' => 'admin.hub.create',
    'uses' => 'HubController@create'
]);

Route::post('admin-hub-store', [
    'as' => 'admin.hub.store',
    'uses' => 'HubController@store'
]);
Route::get('admin-hub-show/{id}', [
    'as' => 'admin.hub.show',
    'uses' => 'HubController@show'
]);
Route::get('admin-hub-edit/{id}', [
    'as' => 'admin.hub.edit',
    'uses' => 'HubController@edit'
]);

Route::patch('admin-hub-update/{id}', [
    'as' => 'admin.hub.update',
    'uses' => 'HubController@update'
]);

Route::get('admin-hub-destroy/{id}', [
    'as' => 'admin.hub.destroy',
    'uses' => 'HubController@destroy'
]);