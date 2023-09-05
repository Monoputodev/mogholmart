<?php

    #Start Customer Authentication Route

    Route::get('customer/account', [
        'as' => 'web.customer.account',
        'uses' => 'CustomerController@index'
    ]); 

    Route::get('customer/register', [
        'as' => 'web.customer.register',
        'uses' => 'CustomerController@register'
    ]);

    Route::get('pb/confirm/email/{slug}','CustomerController@confirm_email');
    
    Route::post('validate/postcode','CustomerController@validatePostCode');

  
    Route::post('customer/do/register', [
        'as' => 'customer.do.register',
        'uses' => 'CustomerController@do_register'
    ]);
    
    Route::post('customer/post/login', [
        'as' => 'customer.post.login',
        'uses' => 'CustomerController@post_login'
    ]);

    //password reset page..............
    
    Route::get('customer/forget/password', [
        'as' => 'customer.resetpassword',
        'uses' => 'CustomerController@resetpassword'
    ]);
    
    Route::post('customer/send/mail', [
        'as' => 'customer.resetpassword.sendmail',
        'uses' => 'CustomerController@sendmailtouser'
    ]);
    
    Route::get('reset/customer/password/{slug}','CustomerController@change_form');
    
    Route::post('customer/save-change', [
        'as' => 'customer.pass.change',
        'uses' => 'CustomerController@save_chage_password'
    ]);
    
    Route::get('customer/prescription', [
            'as' => 'customer.prescription',
            'uses' => 'CustomerController@prescription'
        ]);
    #After customer login, redirect to dashboard and set "cutomer middleware for authentication"

    Route::group(['module' => 'Web', 'middleware' => ['web','webcustomermiddleware']], function(){

        Route::get('customer/dashboard', [
            'as' => 'customer.dashboard',
            'uses' => 'CustomerController@dashboard'
        ]);

        #Update Profile
        Route::get('customer/profile', [
            'as' => 'customer.profile',
            'uses' => 'CustomerController@profile'
        ]);

        Route::post('customer/profile/update', [
            'as' => 'customer.do_customer_edit_info',
            'uses' => 'CustomerController@do_customer_edit_information'
        ]);
        #End Update Profile

        Route::get('customer/logout', [
            'as' => 'customer.logout',
            'uses' => 'CustomerController@customer_logout'
        ]);

        #This route work when user login there account.then he can change his account password.
        Route::get('customer/change/password', [
            'as' => 'customer.change.password',
            'uses' => 'CustomerController@change_password'
        ]);

        Route::post('change/password/submit', [
            'as' => 'password.change',
            'uses' => 'CustomerController@change_password_submit'
        ]);


        Route::get('customer/address', [
            'as' => 'customer.address',
            'uses' => 'CustomerController@address'
        ]);

        #Return area accouring to city
        #This request call by post method with ajax request

        Route::post('call/city/area','CustomerController@area');

        #End

        Route::post('customer/billing/shipping/store', [
            'as' => 'customer.billing.shipping.store',
            'uses' => 'CustomerController@store_billing_shipping'
        ]);

        Route::get('customer/billing/shipping/address/edit/{id}', [
            'as' => 'customer.edit.shipping.billing.address',
            'uses' => 'CustomerController@edit_billing_address'
        ]);

        Route::patch('customer/update/billing/shipping/info/{id}', [
            'as' => 'customer.update.billing.shipping.info',
            'uses' => 'CustomerController@update_billing_shipping_address'
        ]);

        Route::get('customer/delete/shipping/billing/address/{id}', [
            'as' => 'customer.delete.shipping.billing.address',
            'uses' => 'CustomerController@destroy_billing_shipping'
        ]);

        #End route for change password.
        #Customer Order History
        Route::get('customer/order', [
            'as' => 'customer.order',
            'uses' => 'CustomerController@CustomerOrder'
        ]);

        Route::get('customer/order/show/{id}', [
            'as' => 'customer.order.show',
            'uses' => 'CustomerController@show_order'
        ]);

        Route::get('customer/order/todays', [
            'as' => 'customer.todays.order',
            'uses' => 'CustomerController@todays_order'
        ]);

        Route::get('customer/order/fifteendays', [
            'as' => 'customer.last.fifteendays.order',
            'uses' => 'CustomerController@fifteen_todays_order'
        ]);

        Route::get('customer/order/current/month', [
            'as' => 'customer.currnet.month.order',
            'uses' => 'CustomerController@current_month_order'
        ]);

        Route::post('customer/order/change/refund', [
            'as' => 'customer.change.order.refund',
            'uses' => 'CustomerController@change_order_refund'
        ]);

        #End Order History



        Route::get('customer/wishlist', [
            'as' => 'customer.wishlist',
            'uses' => 'CustomerController@wishlist'
        ]);

        Route::any('customer/add/to/wishlist', [
            'as' => 'customer.add.to.wishlist',
            'uses' => 'CustomerController@WishlistStore'
        ]);

        Route::get('customer/remove/to/wishlist/{id}', [
            'as' => 'customer.remove.to.wishlist',
            'uses' => 'CustomerController@RemoveWishlistItem'
        ]);

        Route::get('customer/review', [
            'as' => 'customer.review',
            'uses' => 'CustomerController@review'
        ]);
        #Start Product Review route
        Route::post('customer/review/store', [
            'as' => 'customer.review.store',
            'uses' => 'CustomerController@ReviewStore'
        ]);

        #customer Prescription

        


        Route::post('customer/prescription/store', [
            'as' => 'prescription.store',
            'uses' => 'CustomerController@prescriptionStore'
        ]);


        Route::get('prescription/image/delete/{id}','CustomerController@DeleteImage');


}); #End customer middilware.


