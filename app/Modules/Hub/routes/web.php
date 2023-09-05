<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::group(['module' => 'Hub', 'middleware' => ['web','adminmiddleware'], 'namespace' => 'App\Modules\Hub\Controllers'], function() {

    //Route::resource('Hub', 'HubController');

    include('hub_route.php');

});
