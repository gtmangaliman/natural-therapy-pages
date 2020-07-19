<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('pratitioners/get/{page:[0-9]+}/{limit:[0-9]+}', [
    'uses' => 'PractitionersController@index'
]);

$router->group(['prefix' => 'pratitioners', 'middleware' => 'auth'], function() use ($router){

	$router->post('create', [
	    'uses' => 'PractitionersController@store'
	]);

	$router->put('update', [
	    'uses' => 'PractitionersController@update'
	]);

	$router->delete('delete', [
	    'uses' => 'PractitionersController@destroy'
	]);
});




