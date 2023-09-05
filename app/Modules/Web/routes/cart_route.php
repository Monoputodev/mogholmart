<?php

    Route::get('cart', [
        'as' => 'web.my.cart',
        'uses' => 'CartController@cart'
    ]);
    
    Route::get('checkout', [
        'as' => 'web.cart.checkout',
        'uses' => 'CartController@checkout'
    ]);
    
    Route::post('web/cart/add', [
        'as' => 'web.cart.add',
        'uses' => 'CartController@add_items'
    ]);

    Route::any('product/quick/view', [
        'as' => 'product.quick.view',
        'uses' => 'CartController@product_quick_view'
    ]);
    
    
    Route::post('web/coupon/price', [
        'as' => 'web.coupoon.price',
        'uses' => 'CartController@coupon_code'
    ]);
    
    Route::post('cart/update', [
        'as' => 'web.cart.update',
        'uses' => 'CartController@cart_update'
    ]);
    
    Route::post('cart/update/ajax', [
        'as' => 'web.cart.update.ajax',
        'uses' => 'CartController@cart_update_ajax'
    ]);
    
    Route::post('cart/delete', [
        'as' => 'web.cart.remove.item',
        'uses' => 'CartController@remove_item'
    ]);
    
    Route::post('cart/delete/ajax', [
        'as' => 'web.cart.remove.item.ajax',
        'uses' => 'CartController@remove_item_ajax'
    ]);
    
    Route::any('checkout/confirm', [
        'as' => 'web.cart.confirm.checkout',
        'uses' => 'CartController@confirm_checkout'
    ]);

    Route::get('checkout/fail', [
        'as' => 'web.cart.checkout.fail',
        'uses' => 'CartController@checkout_fail'
    ]);
    
    Route::any('checkout/success/{order_number}', [
        'as' => 'web.cart.checkout.success',
        'uses' => 'CartController@checkout_success'
    ]);

    //checkout return customer login 
    Route::post('checkout/login', [
        'as' => 'checkout.post.login',
        'uses' => 'CartController@checkoutLogin'
    ]);

    //call city to area
    Route::post('call/city/area/shipping','CartController@citytoarea');
    Route::post('billing/address/city','CartController@citytoarea');
    //ecourer route


    Route::get('checkout/billing/shipping/address/edit/{id}', [
        'as' => 'checkout.edit.shipping.billing.address',
        'uses' => 'CartController@edit_billing_address'
    ]);

    Route::patch('checkout/update/billing/shipping/info/{id}', [
        'as' => 'checkout.update.billing.shipping.info',
        'uses' => 'CartController@update_billing_shipping_address'
    ]);

    Route::get('checkout/delete/shipping/billing/address/{id}', [
        'as' => 'checkout.delete.shipping.billing.address',
        'uses' => 'CartController@destroy_billing_shipping'
    ]);
