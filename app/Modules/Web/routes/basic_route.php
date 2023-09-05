<?php
	
	Route::post('product/load/more', 'WebController@loadmoreIndex');

	Route::get('about/us', [
		'as' => 'web.about.us',
		'uses' => 'WebController@about_us'
	]);

	Route::get('privacy/policy', [
		'as' => 'web.privacy.ploicy',
		'uses' => 'WebController@privacy_policy'
	]);

	Route::get('contact/us', [
		'as' => 'web.contact.us',
		'uses' => 'WebController@contact_us'
	]);

	Route::post('contact/mail/send', [
		'as' => 'contact.mail.submit',
		'uses' => 'WebController@contact_mail'
	]);

	//Route::post('web/subscription','WebController@subscription');

	Route::get('faq', [
		'as' => 'web.faq',
		'uses' => 'WebController@faq'
	]);

	Route::post('web/subscription', [
		'as' => 'web.subscription',
		'uses' => 'WebController@subscription'
	]);

	Route::get('return/refund', [
		'as' => 'web.return.refund',
		'uses' => 'WebController@return_refund'
	]);

	Route::get('shopping/guide', [
		'as' => 'web.shopping.guide',
		'uses' => 'WebController@shopping_guide'
	]);

	Route::get('terms/condition', [
		'as' => 'web.terms.condition',
		'uses' => 'WebController@terms_condition'
	]);

	Route::get('promotion', [
		'as' => 'web.promotion',
		'uses' => 'WebController@promotion'
	]);

	Route::get('code/conduct', [
		'as' => 'web.code.conduct',
		'uses' => 'WebController@code_conduct'
	]);

	Route::get('support', [
		'as' => 'web.support',
		'uses' => 'WebController@support'
	]);

	Route::get('our/goal', [
		'as' => 'web.our.goal',
		'uses' => 'WebController@our_goal'
	]);

	//search for mobile and web

	Route::any('search', [
		'as' => 'web.search',
		'middleware'=>'strim_empty_parem',
		'uses' => 'WebSearchController@index'
	]);

	/*Route::get('search/{query}', [
		'middleware'=>'strim_empty_parem',
		'as' => 'web.autocomplete.search',
		'uses' => 'WebSearchController@search_product_for_web'
	]);*/


	Route::any('search/mobile', [
		'as' => 'web.search.mobile',
		'uses' => 'WebSearchController@index'
	]);