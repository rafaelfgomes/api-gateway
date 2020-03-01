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

$apiPrefix = strval(env('API_PREFIX'));
$apiVersion = strval(env('API_VERSION'));

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([ 'prefix' => $apiPrefix ], function () use ($router, $apiVersion) {

    $router->group([ 'prefix' => $apiVersion ], function () use ($router)  {

        $router->group([ 'middleware' => 'client.credentials' ], function () use ($router){

            $router->get('profiles[/{id}]', 'ProfilesController@show');
            $router->group([ 'prefix' => 'profiles' ], function ($router) {
                $router->post('/', 'ProfilesController@store');
                $router->put('/{id}', 'ProfilesController@update');
                $router->delete('/{id}', 'ProfilesController@delete');
                $router->post('/activate/{id}', 'ProfilesController@activate');
            });

        });

    });

});


