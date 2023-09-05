<?php

Route::get('productReport/index', [
	'as' => 'admin.product.report.index',
	'uses' => 'ProductReportController@index'
]);

Route::get('productReport/todays/report/index', [
	'as' => 'admin.product.todays.product.report',
	'uses' => 'ProductReportController@todays_update'
]);

Route::get('productReport/total/report/update', [
	'as' => 'admin.product.total.update.report',
	'uses' => 'ProductReportController@total_product'
]);

Route::get('productReport/fifteendays/report/index', [
	'as' => 'admin.product.fifteendays.product.report',
	'uses' => 'ProductReportController@fifteendays_update'
]);


Route::get('productReport/last/onemonth/report/index', [
	'as' => 'admin.product.last.onemonth.product.report',
	'uses' => 'ProductReportController@lastonemonth_update'
]);

Route::get('productReport/this/onemonth/report/index', [
	'as' => 'admin.product.onemonth.product.report',
	'uses' => 'ProductReportController@currentmonth_update'
]);



Route::post('productReport/custom/report/submit', [
	'as' => 'admin.product.custom.form.submit',
	'uses' => 'ProductReportController@customreport'
]);

Route::post('productReport/entry/report/submit', [
	'as' => 'admin.product.entry.form.submit',
	'uses' => 'ProductReportController@prouduct_entry'
]);

Route::post('productReport/update/report/submit', [
	'as' => 'admin.product.update.form.submit',
	'uses' => 'ProductReportController@product_update'
]);