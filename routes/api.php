<?php


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function(\Illuminate\Routing\Router $router){
	$router->get('/banner', 'ApiController@banner');
	$router->get('/attach', 'ApiController@attach');
});