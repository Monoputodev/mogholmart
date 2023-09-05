<?php

/*------------------------------------*/
/*shipping-calculation */
Route::get('admin-shipping-calculation-index', [
    'as' => 'admin.shipping.calculation.setting.index',
    'uses' => 'ShippingCalculationController@index'
]);

Route::get('admin-shipping-calculation-create', [
    'as' => 'admin.shipping.calculation.setting.create',
    'uses' => 'ShippingCalculationController@create'
]);


Route::get('admin-shipping-calculation-search', [
    'as' => 'admin.shipping.calculation.setting.search',
    'uses' => 'ShippingCalculationController@search'
]);

Route::post('admin-shipping-calculation-store', [
    'as' => 'admin.shipping.calculation.setting.store',
    'uses' => 'ShippingCalculationController@store'
]);

Route::get('admin-shipping-calculation-show/{id}', [
    'as' => 'admin.shipping.calculation.setting.show',
    'uses' => 'ShippingCalculationController@show'
]);
Route::get('admin-shipping-calculation-edit/{id}', [
    'as' => 'admin.shipping.calculation.setting.edit',
    'uses' => 'ShippingCalculationController@edit'
]);


Route::patch('admin-shipping-calculation-update/{id}', [
    'as' => 'admin.shipping.calculation.setting.update',
    'uses' => 'ShippingCalculationController@update'
]);
Route::get('admin-shipping-calculation-destroy/{id}', [
    'as' => 'admin.shipping.calculation.setting.destroy',
    'uses' => 'ShippingCalculationController@destroy'
]);