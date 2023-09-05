<?php

/*------------------------------------*/
/*new order */
Route::get('admin/new/order/index', [
    'as' => 'admin.new.order',
    'uses' => 'NewOrderController@index'
]);

Route::get('admin/new/order/search', [
    'as' => 'admin.new.order.search',
    'uses' => 'NewOrderController@search'
]);



Route::get('admin/new/search/product/{query}', [
    'middleware'=>'strim_empty_parem',
    'as' => 'admin.new.order.search.product',
    'uses' => 'NewOrderController@search_product_for_order'
]);


Route::post('admin/cart/add', [
    'as' => 'admin.cart.add',
    'uses' => 'NewOrderController@add_items'
]);



Route::post('admin/cart/update', [
    'as' => 'admin.cart.update',
    'uses' => 'NewOrderController@cart_update'
]);

Route::post('admin/cart/delete', [
    'as' => 'admin.cart.remove.item',
    'uses' => 'NewOrderController@remove_item'
]);


Route::get('admin/checkout/customer/search', [
    'as' => 'admin.checkout.post.login.search',
    'uses' => 'NewOrderController@customer_search'
]);

Route::any('admin/confirm/checkout', [
    'as' => 'admin.cart.confirm.checkout',
    'uses' => 'NewOrderController@guest_confirm_checkout'
]);

Route::any('admin/exist/confirm/checkout', [
    'as' => 'admin.exist.cart.confirm.checkout',
    'uses' => 'NewOrderController@exist_confirm_checkout'
]);

Route::get('admin/checkout/fail', [
    'as' => 'admin.cart.checkout.fail',
    'uses' => 'NewOrderController@checkout_fail'
]);

Route::any('admin/checkout/success/{order_number}', [
    'as' => 'admin.cart.checkout.success',
    'uses' => 'NewOrderController@checkout_success'
]);

Route::any('admin/exist/checkout/success/{order_number}/{user_search_id}', [
    'as' => 'admin.exits.cart.checkout.success',
    'uses' => 'NewOrderController@exist_checkout_success'
]);

Route::post('admin/add/order/shipping/address', [
    'as' => 'admin.add.order.shipping.address',
    'uses' => 'NewOrderController@add_shipping_address'
]);

Route::post('admin/coupon/price', [
    'as' => 'admin.coupoon.price',
    'uses' => 'NewOrderController@coupon_code_form'
]);


Route::post('admin/city/to/area/ecourier','NewOrderController@citytoarea');

Route::post('admin/ajax/shipping/wise/cost','NewOrderController@gen_delivery_cost_show_existing');
