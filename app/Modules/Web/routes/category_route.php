<?php

/*------------------------------------*/
/*category */
Route::get('collection/{slug}', [
	'middleware' => 'strim_empty_parem',
    'as' => 'category.slug',
    'uses' => 'WebCategoryController@index'
]);

Route::get('collection/{main_category_slug}/{slug}', [
	'middleware' => 'strim_empty_parem',
    'as' => 'category.child.slug',
    'uses' => 'WebCategoryController@sub_category'
]);

Route::get('collection/{main_category_slug}/{child_category_slug}/{slug}', [
	'middleware' => 'strim_empty_parem',
    'as' => 'category.child.child.slug',
    'uses' => 'WebCategoryController@sub_category_second'
]);
