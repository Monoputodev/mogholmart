<?php

Route::get('salesReport/index', [
	'as' => 'admin.sales.report.index',
	'uses' => 'SalesReportController@index'
]);

Route::get('salesReport/search', [
    'as' => 'admin.sales.search',
    'uses' => 'SalesReportController@search_order'
]);

