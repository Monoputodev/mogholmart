<?php 
//system route list

Route::get('settings/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/index',
    'as' => 'admin.settings.index',
    'uses' => 'SettingsController@index'
]);


Route::get('settings/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/create',
    'as' => 'admin.settings.create',
    'uses' => 'SettingsController@create'
]);

Route::post('settings/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/store',
    'as' => 'admin.settings.store',
    'uses' => 'SettingsController@store'
]);

Route::get('settings/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/show/{id}',
    'as' => 'admin.settings.show',
    'uses' => 'SettingsController@show'
]);
Route::get('settings/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/edit/{id}',
    'as' => 'admin.settings.edit',
    'uses' => 'SettingsController@edit'
]);

Route::patch('settings/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/update/{id}',
    'as' => 'admin.settings.update',
    'uses' => 'SettingsController@update'
]);

Route::get('settings/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/settings/destroy/{id}',
    'as' => 'admin.settings.destroy',
    'uses' => 'SettingsController@destroy'
]);

Route::get('settings/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.settings.search',
    'uses' => 'SettingsController@search'
]);

?>