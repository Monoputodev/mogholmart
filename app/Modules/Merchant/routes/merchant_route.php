<?php

Route::get('merchant-corner', [
    'as' => 'merchant.corner',
    'uses' => 'MerchantController@index'
]);

Route::get('merchant-corner/registration', [
    'as' => 'registration.merchant.corner',
    'uses' => 'MerchantController@registration'
]);

Route::get('merchant/do-registration', [
    'as' => 'merchant.do_registration',
    'uses' => 'MerchantController@do_registration'
]);


Route::post('merchant/do-registration', [
    'as' => 'merchant.do_registration',
    'uses' => 'MerchantController@do_registration'
]);

Route::get('merchant/confirm-email/{slug}', 'MerchantController@confirm_email');

Route::get('merchant/login', [
    'as' => 'login.merchant.corner',
    'uses' => 'MerchantController@login'
]);

Route::post('merchant/post-login', [
    'as' => 'merchant.post.login',
    'uses' => 'MerchantController@post_login'
]);

Route::group(['module' => 'Merchant', 'middleware' => ['web', 'webmerchantmiddleware']], function () {

    Route::get('merchant/dashboard', [
        'as' => 'merchant.dashboard',
        'uses' => 'MerchantController@dashboard'
    ]);

    Route::get('merchant/profile', [
        'as' => 'merchant.profile',
        'uses' => 'MerchantController@merchant_profile'
    ]);

    Route::post('merchant/edit-profile', [
        'as' => 'merchant.post.edit.profile',
        'uses' => 'MerchantController@edit_merchant_profile'
    ]);

    Route::get('merchant/my-product', [
        'as' => 'merchant.my.product',
        'uses' => 'MerchantController@my_product'
    ]);

    //merchat wise product comission details

    Route::get('merchant/commission-details', [
        'as' => 'merchant.comission.details',
        'uses' => 'MerchantController@merchant_comission_details'
    ]);


    Route::post('merchant/product-store', [
        'as' => 'merchant.product.store',
        'uses' => 'MerchantController@store'
    ]);


    Route::get('merchant/product-edit/{id}', [
        'as' => 'merchant.product.edit',
        'uses' => 'MerchantController@edit'
    ]);

    Route::get('merchant/product-duplicate/{id}', [
        'as' => 'merchant.product.clone',
        'uses' => 'MerchantController@duplicate'
    ]);

    Route::post('merchant-product-brand', 'MerchantController@getbrand');


    Route::patch('merchant-besic-info-add/{id}', 'MerchantController@update_basic');

    /*product image*/


    Route::patch('merchant-product-image-update/{id}', [
        'as' => 'merchant.product.update_image',
        'uses' => 'MerchantController@update_image'
    ]);


    Route::get('merchant-product-image-show/{id}', [
        'as' => 'merchant.product.image.show',
        'uses' => 'MerchantController@image_show'
    ]);

    Route::get('merchant-image-delete/{id}', 'MerchantController@DeleteImage');

    Route::patch('merchant-description-update/{id}', 'MerchantController@description_update');
    Route::patch('merchant-seo-update/{id}', 'MerchantController@seo_update');
    Route::patch('merchant-inventory-update/{id}', 'MerchantController@inventory_update');
    Route::patch('merchant-category-update/{id}', 'MerchantController@category_update');
    Route::patch('merchant-attribute-update/{id}', 'MerchantController@product_attribute_update');


    Route::get('merchant/product-show/{id}', [
        'as' => 'merchant.product.show',
        'uses' => 'MerchantController@merchant_product_show'
    ]);

    Route::get('merchant/product-delete/{id}', [
        'as' => 'merchant.product.delete',
        'uses' => 'MerchantController@destroy'
    ]);

    Route::get('merchant/reset-password/{id}', [
        'as' => 'merchant.resetpassword',
        'uses' => 'MerchantController@reset_password_form'
    ]);

    Route::post('merchant/password-save-change', [
        'as' => 'merchant.password.reset',
        'uses' => 'MerchantController@password_reset'
    ]);


    Route::get('merchant/logout', [
        'as' => 'merchant.logout',
        'uses' => 'MerchantController@merchant_logout'
    ]);

//start merchant order index===========================

    Route::get('merchant/order-index', [
        'as' => 'merchant.order.index',
        'uses' => 'MerchantOrderController@index'
    ]);



    Route::get('merchant/order-details/{id}', [
        'as' => 'merchant.order.show',
        'uses' => 'MerchantOrderController@show'
    ]);

    Route::get('merchant/order-destroy/{id}', [
        'as' => 'merchant.order.destroy',
        'uses' => 'MerchantOrderController@destroy'
    ]);

  //start merchant dashboard route link

    Route::get('merchant/todyas-order', [
        'as' => 'todays.order.list',
        'uses' => 'MerchantOrderController@todays_order'
    ]);

    Route::get('merchant/fifteendays-order', [
        'as' => 'fifteendays.order.list',
        'uses' => 'MerchantOrderController@fifteendays_order'
    ]);

    Route::get('merchant/current-month-order', [
        'as' => 'current.month.order.list',
        'uses' => 'MerchantOrderController@current_month_order'
    ]);
    Route::get('merchant/total-order', [
        'as' => 'total.order.list',
        'uses' => 'MerchantOrderController@total_order'
    ]);
   

    Route::get('merchant/current-month-product-list', [
        'as' => 'current.month.product.list',
        'uses' => 'MerchantController@current_month_product_list'
    ]);

   

});  // end merchant middleware=======================

Route::get('merchant/forget-password', [
    'as' => 'merchant.forgetpassword',
    'uses' => 'MerchantController@forget_password'
]);



Route::post('merchant/send-mail', [
    'as' => 'merchant.forgetpassword.sendmail',
    'uses' => 'MerchantController@send_mail_to_merchant'
]);

Route::get('merchant-send-mail-for-password-reset/{slug}', 'MerchantController@change_password_form');


Route::post('merchant/save-change', [
    'as' => 'merchant.password.change',
    'uses' => 'MerchantController@save_chage_password'
]);


