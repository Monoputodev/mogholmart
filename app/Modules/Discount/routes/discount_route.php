<?php

/*------------------------------------*/
/*hub */
Route::get('admin-discount-index', [
    'as' => 'admin.discount.index',
    'uses' => 'DiscountController@index'
]);

Route::get('admin-discount-category', 'DiscountController@find_category');

Route::get('admin-discount-search', [
    'as' => 'admin.discount.search',
    'uses' => 'DiscountController@search'
]);

Route::get('admin-discount-create', [
    'as' => 'admin.discount.create',
    'uses' => 'DiscountController@create'
]);

Route::post('admin-discount-store', [
    'as' => 'admin.discount.store',
    'uses' => 'DiscountController@store'
]);
Route::get('admin-discount-show/{id}', [
    'as' => 'admin.discount.show',
    'uses' => 'DiscountController@show'
]);
Route::get('admin-discount-edit/{id}', [
    'as' => 'admin.discount.edit',
    'uses' => 'DiscountController@edit'
]);

Route::patch('admin-discount-update/{id}', [
    'as' => 'admin.discount.update',
    'uses' => 'DiscountController@update'
]);

Route::get('admin-discount-destroy/{id}', [
    'as' => 'admin.discount.destroy',
    'uses' => 'DiscountController@destroy'
]);