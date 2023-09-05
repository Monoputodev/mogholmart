<?php

/*------------------------------------*/
/*brand */
Route::get('brand', [
    'as' => 'brand.index',
    'uses' => 'WebBrandController@index'
]);

Route::get('brand/{slug}', [
	'middleware' => 'strim_empty_parem',
    'as' => 'brand.slug',
    'uses' => 'WebBrandController@product_list'
]);
