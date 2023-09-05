

<?php

	// category wish price update
	Route::get('admin-price-update-index', [
		'as' => 'admin.price.update.index',
		'uses' => 'PriceController@index'
	]);

	Route::get('admin-price-update-category', [
		'as' => 'admin.price.update.category',
		'uses' => 'PriceController@category_product_list'
	]);

	Route::POST('admin-price-update-store', [
		'as' => 'admin.price.update.store',
		'uses' => 'PriceController@update_price_store'
	]);

	Route::get('admin-price-update-undo/{id}', [
		'as' => 'admin.price.update.undo',
		'uses' => 'PriceController@undo'
	]);

	Route::get('admin-price-update-details/{id}', [
		'as' => 'admin.price.update.details',
		'uses' => 'PriceController@update_details'
	]);

	// Merchant wish price update
	Route::get('admin-price-update-merchant-index', [
		'as' => 'admin.price.update.merchant.index',
		'uses' => 'PriceController@merchant_index'
	]);

	Route::get('admin-price-update-merchant', [
		'as' => 'admin.price.update.merchant',
		'uses' => 'PriceController@merchant_product_list'
	]);

	


	
?>