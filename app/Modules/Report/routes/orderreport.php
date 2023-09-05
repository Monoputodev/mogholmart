<?php

Route::get('orderReport/index', [
	'as' => 'admin.order.report.index',
	'uses' => 'OrderReportController@index'
]);

Route::get('orderReport/todays/report', [
	'as' => 'admin.order.todays.order.report',
	'uses' => 'OrderReportController@todays_order'
]);

Route::get('orderReport/total/report', [
	'as' => 'admin.order.total.order.report',
	'uses' => 'OrderReportController@total_order'
]);

Route::get('orderReport/fifteendays/report', [
	'as' => 'admin.order.fifteendays.order.report',
	'uses' => 'OrderReportController@fifteendays_order'
]);


Route::get('orderReport/last/onemonth/report', [
	'as' => 'admin.order.last.onemonth.order.report',
	'uses' => 'OrderReportController@lastonemonth_order'
]);

Route::get('orderReport/this/onemonth/report', [
	'as' => 'admin.order.onemonth.order.report',
	'uses' => 'OrderReportController@currentmonth_order'
]);



Route::post('orderReport/custom/report/submit', [
	'as' => 'admin.order.custom.form.submit',
	'uses' => 'OrderReportController@customreport'
]);

Route::post('orderReport/custom/report/by/payment', [
	'as' => 'admin.order.custom.bypayment.form.submit',
	'uses' => 'OrderReportController@customreport_by_payment'
]);
