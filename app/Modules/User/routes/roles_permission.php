<?php
/*------------------------------------*/
/*Roles */
Route::get('rolesPermission/index', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesPermission/index',
	'as' => 'admin.roles.permission.index',
	'uses' => 'RolesController@roles_permission_index'
]);

Route::get('rolesPermission/{id}', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesPermission/{id}',
	'as' => 'admin.roles.permission',
	'uses' => 'RolesController@roles_permission'
]);


Route::post('rolesPermission/assigned', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesPermission/assigned',
	'as' => 'admin.roles.permission.store',
	'uses' => 'RolesController@assigned_store'
]);

Route::post('rolesPermission/unassigned', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/rolesPermission/unassigned',
	'as' => 'admin.roles.permission.unassigned.store',
	'uses' => 'RolesController@unassigned_store'
]);

