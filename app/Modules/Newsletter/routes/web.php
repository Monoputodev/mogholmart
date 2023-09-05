<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

}
Route::group(['prefix' => config('global.prefix_name'),'module' => 'Newsletter', 'middleware' => ['web','adminmiddleware','redirect_if_logout'], 'namespace' => 'App\Modules\Newsletter\Controllers'], function() {

	Route::get('subscription/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/subscription/index',
		'as' => 'admin.subscription.index',
		'uses' => 'SubscriptionController@index'
	]);


	Route::get('subscription/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/subscription/destroy/{id}',
		'as' => 'admin.subscription.destroy',
		'uses' => 'SubscriptionController@destroy'
	]);

	Route::get('subscription/search', [
		'middleware' => 'strim_empty_parem',
		'as' => 'admin.subscription.search',
		'uses' => 'SubscriptionController@search'
	]);

});
