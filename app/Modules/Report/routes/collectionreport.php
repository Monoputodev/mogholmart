<?php

Route::get('collectionReport/index', [
	'as' => 'admin.collection.report.index',
	'uses' => 'CollectionReportController@index'
]);


Route::get('collectionReport/search', [
	'as' => 'admin.collection.search',
	'uses' => 'CollectionReportController@search_index'
]);



/*Route::get('admin-collection-search', [
    'as' => 'admin.collection.search',
    'uses' => 'CollectionReportController@search_order'
]);
*/