<?php
/*/-----------------------------------*/
/*permission */
Route::get('permission/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/permission/index',
    'as' => 'admin.permission.index',
    'uses' => 'PermissionController@index'
]);


Route::get('permission/add',[
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/permission/add',
    'as' => 'admin.route.add',
    'uses' => 'PermissionController@route_add'
]);

Route::get('permission/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/permission/edit/{id}',
    'as' => 'admin.permission.edit',
    'uses' => 'PermissionController@edit'
]);

Route::patch('permission/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/permission/update/{id}',
    'as' => 'admin.permission.update',
    'uses' => 'PermissionController@update'
]);
Route::get('permission/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/permission/destroy/{id}',
    'as' => 'admin.permission.destroy',
    'uses' => 'PermissionController@destroy'
]);


Route::get('permission/search',[
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/admin/permission/search',
    'as' => 'admin.route.search',
    'uses' => 'PermissionController@route_search'

]); 