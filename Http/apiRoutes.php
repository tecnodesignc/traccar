<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/traccar/v1','middleware' => 'api.token'], function (Router $router) {
$router->group(['prefix' =>'/tokens'], function (Router $router) {

  /*  $router->get('/', [
        'as' => 'api.traccar.token.index',
        'uses' => 'TokenApiController@index',
        'middleware' => ['auth:api']
    ]);*/

    $router->post('/', [
        'as' => 'api.traccar.token.store',
        'uses' => 'TokenApiController@store',
        //'middleware' => ['token-can:traccar.tokens.store']
    ]);

  /*  $router->get('/{criteria}', [
        'as' => 'api.traccar.token.show',
        'uses' => 'TokenApiController@show',
        'middleware' => ['auth:api']
    ]);
    $router->put('/{criteria}', [
        'as' => 'api.traccar.token.update',
        'uses' => 'TokenController@update',
        'middleware' => ['auth:api']
    ]);
    $router->delete('/{criteria}', [
        'as' => 'api.traccar.token.destroy',
        'uses' => 'TokenApiController@destroy',
        'middleware' => ['auth:api']
    ]);*/

});

// append

});
