<?php

Route::get('all/merchant/list', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/list',
    'as' => 'admin.merchant.list',
    'uses' => 'AdminMerchantController@index'
]);

Route::get('merchant/switch', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/merchant/switch',
    'as' => 'admin.merchant.switching',
    'uses' => 'AdminMerchantController@merchant_switch'
]);

Route::post('merchant/switch/patch', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/merchant/switch/patch',
    'as' => 'admin.merchant.switching.store',
    'uses' => 'AdminMerchantController@merchant_switch_patch'
]);

Route::get('all/merchant/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/create',
    'as' => 'admin.merchant.create',
    'uses' => 'AdminMerchantController@create'
]);

Route::post('all/merchant/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/merchant/store',
    'as' => 'admin.merchant.store',
    'uses' => 'AdminMerchantController@store'
]);

Route::get('all/merchant/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/show/{id}',
    'as' => 'admin.merchant.show',
    'uses' => 'AdminMerchantController@show'
]);

Route::get('all/merchant/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/edit/{id}',
    'as' => 'admin.merchant.edit',
    'uses' => 'AdminMerchantController@edit'
]);

Route::patch('all/merchant/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/update/{id}',
    'as' => 'admin.merchant.update',
    'uses' => 'AdminMerchantController@update'
]);

Route::get('all/merchant/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/all/merchant/destroy/{id}',
    'as' => 'admin.merchant.destroy',
    'uses' => 'AdminMerchantController@destroy'
]);

Route::get('merchant/search', [
    'as' => 'admin.merchant.search',
    'uses' => 'AdminMerchantController@search'
]);


Route::get('inactive/merchant/list', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/inactive/merchant/list',
    'as' => 'admin.merchant.inactive',
    'uses' => 'AdminMerchantController@index_inactive'
]);


Route::get('non/agreement/merchant/list', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/non/agreement/merchant/list',
    'as' => 'admin.merchant.non.agreement',
    'uses' => 'AdminMerchantController@index_nonagreement'
]);

Route::get('merchant/excell', [
    'as' => 'admin.merchant.excell',
    'uses' => 'AdminMerchantController@admin_merchant_excell'
]);

Route::get('merchant/password/change/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/merchant/password/change/{id}',
    'as' => 'admin.merchant.changepassword',
    'uses' => 'AdminMerchantController@admin_merchant_password_change'
]);

Route::patch('merchant/password/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/merchant/password/update/{id}',
    'as' => 'admin.merchant.password.update',
    'uses' => 'AdminMerchantController@admin_merchant_password_update'
]);
