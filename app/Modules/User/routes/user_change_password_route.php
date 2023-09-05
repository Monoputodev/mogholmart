<?php
/*/-----------------------------------*/
/*user */

Route::get('user/password/reset/{id}', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/user/password/reset/{id}',
    'as' => 'admin.user.password.reset',
    'uses' => 'UserController@password_reset'
]);


Route::patch('user/password/update/{id}', [
	//'middleware' => 'acl_access:'.config('global.prefix_name').'/user/password/update/{id}',
    'as' => 'admin.user.password.update',
    'uses' => 'UserController@update_password'
]);

/*Route::get('user/destroy/{id}', [
    'as' => 'admin.user.destroy',
    'uses' => 'UserController@destroy'
]);*/