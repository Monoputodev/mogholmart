<?php

Route::get('testimonial/index', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/index',
    'as' => 'admin.testimonial.index',
    'uses' => 'TestimonialController@index'
]);

Route::get('testimonial/create', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/create',
    'as' => 'admin.testimonial.create',
    'uses' => 'TestimonialController@create'
]);
Route::get('testimonial/search', [
    'middleware' => 'strim_empty_parem',
    'as' => 'admin.testimonial.search',
    'uses' => 'TestimonialController@search'
]);

Route::post('testimonial/store', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/store',
    'as' => 'admin.testimonial.store',
    'uses' => 'TestimonialController@store'
]);
Route::get('testimonial/show/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/show/{id}',
    'as' => 'admin.testimonial.show',
    'uses' => 'TestimonialController@show'
]);
Route::get('testimonial/edit/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/edit/{id}',
    'as' => 'admin.testimonial.edit',
    'uses' => 'TestimonialController@edit'
]);


Route::patch('testimonial/update/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/update/{id}',
    'as' => 'admin.testimonial.update',
    'uses' => 'TestimonialController@update'
]);
Route::get('testimonial/destroy/{id}', [
    //'middleware' => 'acl_access:'.config('global.prefix_name').'/testimonial/destroy/{id}',
    'as' => 'admin.testimonial.destroy',
    'uses' => 'TestimonialController@destroy'
]);