<?php
/*////////----------------------------*/
/*Roles */
Route::get('roles/index', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/index',
    'as' => 'admin.roles.index',
    'uses' => 'RolesController@index'
]);

Route::get('roles/create', [

   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/create',
    'as' => 'admin.roles.create',
    'uses' => 'RolesController@create'
]);
Route::get('roles/search', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/search',
    'as' => 'admin.roles.search',
    'uses' => 'RolesController@search'
]);

Route::post('roles/store', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/store',
    'as' => 'admin.roles.store',
    'uses' => 'RolesController@store'
]);
Route::get('roles/show/{id}', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/show/{id}',
    'as' => 'admin.roles.show',
    'uses' => 'RolesController@show'
]);
Route::get('roles/edit/{id}', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/edit/{id}',
    'as' => 'admin.roles.edit',
    'uses' => 'RolesController@edit'
]);

Route::patch('roles/update/{id}', [
   //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/update/{id}',
    'as' => 'admin.roles.update',
    'uses' => 'RolesController@update'
]);
Route::get('roles/destroy/{id}', [
 //'middleware' => 'acl_access:'.config('global.prefix_name').'/roles/destroy/{id}',
    'as' => 'admin.roles.destroy',
    'uses' => 'RolesController@destroy'
]);


