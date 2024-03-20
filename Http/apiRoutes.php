<?php

use Illuminate\Routing\Router;
/** @var Router $router */
$router->group(['prefix' =>'/traccar/auth'], function (Router $router) {
    $router->group(['prefix' =>'/login'], function (Router $router) {

        /*  $router->get('/', [
              'as' => 'api.traccar.token.index',
              'uses' => 'TokenApiController@index',
              'middleware' => ['auth:api']
          ]);*/

        $router->post('/', [
            'as' => 'api.traccar.auth.login',
            'uses' => 'TokenApiController@store',
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

});
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
    $router->group(['prefix' =>'/devices'], function (Router $router) {

         $router->get('/', [
              'as' => 'api.traccar.device.index',
              'uses' => 'DeviceApiController@index',
              'middleware' => ['token-can:traccar.tokens.index']
          ]);
        $router->get('/show', [
            'as' => 'api.traccar.device.show',
            'uses' => 'DeviceApiController@show',
            'middleware' => ['token-can:traccar.tokens.index']
        ]);
        $router->get('/command', [
            'as' => 'api.traccar.device.command',
            'uses' => 'DeviceApiController@command',
            'middleware' => ['token-can:traccar.tokens.index']
        ]);
        $router->get('/historic', [
            'as' => 'api.traccar.device.historic',
            'uses' => 'DeviceApiController@historic',
            'middleware' => ['token-can:traccar.tokens.index']
        ]);
});

// append

});
