<?php

/*------------------------------------*/
/*Order */

Route::any('merchantOrder/index', [
    'as' => 'admin.merchant.order.index',
    'uses' => 'OrderController@merchant_index'
]);

Route::get('merchantOrder/search', [
	'middleware'=>'strim_empty_parem',
    'as' => 'admin.merchant.order.search',
    'uses' => 'OrderController@search_merchant_order'
]);

Route::get('merchantOrder/wise/show/{id}', [
    'as' => 'admin.merchant.order.show',
    'uses' => 'OrderController@merchat_wise_order_index'
]);


