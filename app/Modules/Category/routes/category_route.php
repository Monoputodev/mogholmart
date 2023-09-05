<?php

/*------------------------------------*/
/*Category */
Route::get('category/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/index',
    'as' => 'admin.category.index',
    'uses' => 'CategoryController@index'
]);

Route::get('category/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/create',
    'as' => 'admin.category.create',
    'uses' => 'CategoryController@create'
]);


Route::get('category/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.category.search',
    'uses' => 'CategoryController@search'
]);


Route::post('category/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/store',
    'as' => 'admin.category.store',
    'uses' => 'CategoryController@store'
]);
Route::get('category/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/show/{id}',
    'as' => 'admin.category.show',
    'uses' => 'CategoryController@show'
]);
Route::get('category/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/edit/{id}',
    'as' => 'admin.category.edit',
    'uses' => 'CategoryController@edit'
]);

Route::get('sub/category/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/sub/category/{id}',
    'as' => 'admin.sub.category',
    'uses' => 'CategoryController@sub_category'
]);

Route::patch('category/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/update/{id}',
    'as' => 'admin.category.update',
    'uses' => 'CategoryController@update'
]);



Route::get('category/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/destroy/{id}',
    'as' => 'admin.category.destroy',
    'uses' => 'CategoryController@destroy'
]);

//product list=========================================

Route::get('category/product/list/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/category/product/list/{id}',
    'as' => 'admin.category.product.list',
    'uses' => 'CategoryController@category_product_list'
]);


