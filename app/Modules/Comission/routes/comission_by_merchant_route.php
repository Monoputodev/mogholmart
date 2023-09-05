<?php

Route::get('comissionBy/merchant', [
	'as'=>'admin.comission.merchant.index',
	'uses'=>'ComissionController@comission_by_merchant'

]);

Route::get('comissionBy/merchant/search', [
    'as' => 'admin.comission.merchant.search',
    'uses' => 'ComissionController@comission_by_merchant_search'
]);

Route::get('comissionBy/merchant/show/search', [
    'as' => 'admin.comission.merchant.show.search',
    'uses' => 'ComissionController@comission_by_merchant_search_show'
]);

Route::get('comissionBy/merchant/show/{id}', [
    'as' => 'admin.comission.merchant.show',
    'uses' => 'ComissionController@comission_by_merchant_show'
]);