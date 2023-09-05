<?php

Route::group(['module' => 'EMI', 'middleware' => ['api'], 'namespace' => 'App\Modules\EMI\Controllers'], function() {

    Route::resource('EMI', 'EMIController');

});
