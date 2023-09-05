<?php

/*------------------------------------*/
/*Product */

Route::any('inventory/index', [
    'as' => 'admin.product.inventory.index',
    'uses' => 'InventoryController@inventory_index'
]);

Route::get('inventory/search', [
	  'middleware' => 'strim_empty_parem',
    'as' => 'admin.product.inventory.search',
    'uses' => 'InventoryController@search_invetory'
]);

