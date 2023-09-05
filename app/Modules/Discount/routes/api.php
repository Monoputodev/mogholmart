<?php

Route::group(['module' => 'Discount', 'middleware' => ['api'], 'namespace' => 'App\Modules\Discount\Controllers'], function() {

    Route::resource('Discount', 'DiscountController');

});
