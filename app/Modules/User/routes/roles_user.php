<?php
/*------------------------------------*/
/*Roles */
Route::get('rolesUser/index', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesUser/index',
    'as' => 'admin.roles.user.index',
    'uses' => 'RolesController@roles_user_index'
]);

Route::get('rolesUser/{id}', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesUser/{id}',
    'as' => 'admin.roles.user',
    'uses' => 'RolesController@roles_user'
]);


Route::post('rolesUser/assigned', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesUser/assigned',
    'as' => 'admin.roles.user.store',
    'uses' => 'RolesController@assigned_role_store'
]);

Route::post('rolesUser/unassigned', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesUser/unassigned',
    'as' => 'admin.roles.user.unassigned.store',
    'uses' => 'RolesController@unassigned_role_store'
]);

