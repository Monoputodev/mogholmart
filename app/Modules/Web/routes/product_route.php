<?php

/*------------------------------------*/
/*category */

use Illuminate\Support\Facades\Route;

Route::get('product/{slug}', [
    'as' => 'product.slug',
    'uses' => 'WebProductController@index'
]);


Route::post('related-product-more', 'WebProductController@related_product_more');
