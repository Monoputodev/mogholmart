<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::group(['prefix'=>config('global.prefix_name'),'module' => 'User', 'middleware' => ['web','adminmiddleware','redirect_if_logout'], 'namespace' => 'App\Modules\User\Controllers'], function() {


    	include('roles_route.php');
    	include('roles_permission.php');
    	include('roles_user.php');
    	include('permission_route.php');
    	include('user_route.php');
    	include('user_change_password_route.php');
  
});
