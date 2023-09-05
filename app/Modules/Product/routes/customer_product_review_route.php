<?php

Route::get('customer/product/review', [
    'as' => 'admin.customer.product.review',
    'uses' => 'ProductReviewController@index'
]);

Route::get('customer/product/review/create', [
    'as' => 'admin.customer.create.review',
    'uses' => 'ProductReviewController@create'
]);


Route::get('customer/product/review/all', [
    'as' => 'admin.customer.all.review',
    'uses' => 'ProductReviewController@show_all_review'
]);


Route::get('customer/productreview/search', [
    'middleware'=>'strim_empty_parem',
    'as' => 'admin.customer.productreview.search',
    'uses' => 'ProductReviewController@search'
]);

Route::post('customer/productreview/store', [
    'as' => 'admin.customer.review.store',
    'uses' => 'ProductReviewController@store'
]);

Route::get('customer/productreview/show/{id}', [
    'as' => 'admin.customer.productreview.show',
    'uses' => 'ProductReviewController@show'
]);
Route::get('customer/productreview/edit/{id}', [
    'as' => 'admin.customer.productreview.edit',
    'uses' => 'ProductReviewController@edit'
]);


Route::patch('product/review/update/{id}', [
    'as' => 'admin.product.review.update',
    'uses' => 'ProductReviewController@update'
]);


Route::get('customer/product/review/delete/{id}', [
    'as' => 'admin.customer.productreview.destroy',
    'uses' => 'ProductReviewController@destroy'
]);

