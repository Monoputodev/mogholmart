<?php

/*------------------------------------*/
/*product */
Route::get('product/index', [
    'as' => 'admin.product.index',
    'uses' => 'ProductController@index'
]);

Route::get('active/product/index', [
    'as' => 'admin.product.active',
    'uses' => 'ProductController@active_index'
]);

Route::get('inactive/product/index', [
    'as' => 'admin.product.inactive',
    'uses' => 'ProductController@inactive_index'
]);

Route::get('cancel/product/index', [
    'as' => 'admin.product.cancel',
    'uses' => 'ProductController@cancel_index'
]);




Route::get('product/create', [
    'as' => 'admin.product.create',
    'uses' => 'ProductController@create'
]);


Route::get('product/search', [
    'as' => 'admin.product.search',
    'uses' => 'ProductController@search'
]);

Route::post('product/store', [
    'as' => 'admin.product.store',
    'uses' => 'ProductController@store'
]);



Route::get('product/show/{id}', [
    'as' => 'admin.product.show',
    'uses' => 'ProductController@show'
]);
Route::get('product/edit/{id}', [
    'as' => 'admin.product.edit',
    'uses' => 'ProductController@edit'
]);

Route::post('product/brand', 'ProductController@getbrand');

Route::patch('product/update/{id}', [
    'as' => 'admin.product.update',
    'uses' => 'ProductController@update'
]);

Route::get('product/destroy/{id}', [
    'as' => 'admin.product.destroy',
    'uses' => 'ProductController@destroy'
]);

/*product image*/

Route::get('product/image/{id}', [
    'as' => 'admin.product.image',
    'uses' => 'ProductController@image'
]);

Route::get('product/image/show/{id}', [
    'as' => 'admin.product.image.show',
    'uses' => 'ProductController@image_show'
]);

Route::patch('product/image/update/{id}', [
    'as' => 'admin.product.update_image',
    'uses' => 'ProductController@update_image'
]);


Route::get('product/image/delete/{id}','ProductController@DeleteImage');

/*product details*/
Route::get('product/category/{id}', [
    'as' => 'admin.product.category',
    'uses' => 'ProductController@product_category'
]);


/*product details*/
Route::get('product/details/{id}', [
    'as' => 'admin.product.details',
    'uses' => 'ProductController@descriptionform'
]);

Route::patch('product/description/update/{id}', [
    'as' => 'admin.product.update.description',
    'uses' => 'ProductController@description_update'
]);

/*product seo*/

Route::get('product/seo/{id}', [
    'as' => 'admin.product.seo',
    'uses' => 'ProductController@seo'
]);


Route::patch('product/seo/update/{id}', [
    'as' => 'admin.product.seo.update',
    'uses' => 'ProductController@seo_update'
]);

Route::patch('product/category/update/{id}', [
    'as' => 'admin.product.category.update',
    'uses' => 'ProductController@category_update'
]);

/*product attribute*/
Route::get('product/attribute/{id}', [
    'as' => 'admin.product.attribute',
    'uses' => 'ProductController@product_attribute'
]);

Route::patch('product/attribute/update/{id}', [
    'as' => 'admin.product.attribute.update',
    'uses' => 'ProductController@product_attribute_update'
]);

/*product inventory*/
Route::get('product/inventory/{id}', [
    'as' => 'admin.product.inventory',
    'uses' => 'ProductController@product_inventory'
]);

Route::patch('product/inventory/update/{id}', [
    'as' => 'admin.product.inventory.update',
    'uses' => 'ProductController@product_inventory_update'
]);


/*product review*/

Route::get('product/review/{id}', [
    'as' => 'admin.product.review',
    'uses' => 'ProductController@product_review'
]);

/*product preview*/

Route::get('product/preview/{id}', [
    'as' => 'admin.product.preview',
    'uses' => 'ProductController@product_preview'
]);



Route::get('product/emi/{id}', [
    'as' => 'admin.product.emi',
    'uses' => 'ProductController@product_emi'
]);

Route::patch('product/emi/update/{id}', [
    'as' => 'admin.product.emi.update',
    'uses' => 'ProductController@product_emi_update'
]);

//general file uploder...............................

Route::get('general/product/file',[
        'as'=>'admin.product.general.image',
        'uses'=>'ProductController@general_file_uploder'
 ]);

Route::post('general/product/file/upload',[
    'as'=>'admin.product.general.image.store',
    'uses'=>'ProductController@general_file_uploder_store'
 ]);