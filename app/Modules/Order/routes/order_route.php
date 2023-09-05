<?php

/*---------------------------*/
/*Order */

Route::any('order/index', [
    'as' => 'admin.order.index',
    'uses' => 'OrderController@order_index'
]);



Route::get('order/search/order', [
    'middleware'=>'strim_empty_parem',
    'as' => 'admin.order.search',
    'uses' => 'OrderController@search_order'
]);

Route::get('order/show/{id}', [
    'as' => 'admin.order.show',
    'uses' => 'OrderController@show'
]);

Route::post('order/change/status', [
    'as' => 'admin.change.order.status',
    'uses' => 'OrderController@change_order_status'
]);


Route::post('order/change/status/cancel', [
    'as' => 'admin.change.order.status.cancel',
    'uses' => 'OrderController@order_cancel'
]);


Route::post('order/change/refund', [
    'as' => 'admin.change.order.refund',
    'uses' => 'OrderController@change_order_refund'
]);

Route::post('order/change/select/courier', [
    'as' => 'admin.select.courier',
    'uses' => 'OrderController@select_courier'
]);

Route::get('order/destroy/{id}', [
    'as' => 'admin.order.destroy',
    'uses' => 'OrderController@destroy'
]);


Route::get('order/pending/order', [
    'as' => 'all.pending.order',
    'uses' => 'OrderController@pending_order'
]);

Route::get('order/billing/shipping/address/edit/{id}', [
    'as' => 'order.edit.shipping.billing.address',
    'uses' => 'OrderController@edit_billing_address'
]);

Route::patch('order/update/billing/shipping/info/{id}', [
    'as' => 'order.update.billing.shipping.info',
    'uses' => 'OrderController@update_billing_shipping_address'
]);


Route::post('order/update/cashback', [
    'as' => 'admin.update.order.cashback',
    'uses' => 'OrderController@update_order_cashback'
]);

Route::post('order/city/to/area','OrderController@citytoarea');