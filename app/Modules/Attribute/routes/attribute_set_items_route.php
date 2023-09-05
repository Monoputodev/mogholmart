<?php
/*attributeset items */
Route::get('attributeSet/items/{id}', [
	 //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/items/{id}',
    'as' => 'admin.attribute.set.items',
    'uses' => 'AttributesetController@set_items'
]);

Route::get('attributeSet/items/search', [
	 'middleware' => 'strim_empty_parem',
    'as' => 'admin.attribute.set.items.search',
    'uses' => 'AttributesetController@search'
]);

Route::post('attributeSet/items/store', [
	 //'middleware' => 'acl_access:'.config('global.prefix_name').'/attributeSet/items/store',
    'as' => 'admin.attribute.set.items.assigned.store',
    'uses' => 'AttributesetController@assigned_store'
]);

Route::post('attributeSet/items/unassigned', [
	 //'middleware' => 'acl_access:'.config('global.prefix_name').'attributeSet/items/unassigned',
    'as' => 'admin.attribute.set.items.unassigned.store',
    'uses' => 'AttributesetController@unassigned_store'
]);





