<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/traccar'], function (Router $router) {
$router->group(['prefix' =>'/tokens'], function (Router $router) {

    $router->bind('token', function ($id) {
        return app('Modules\Traccar\Repositories\TokenRepository')->find($id);
    });

    $router->get('/', [
        'as' => 'admin.traccar.token.index',
        'uses' => 'TokenController@index',
        'middleware' => 'can:traccar.tokens.index'
    ]);
    $router->get('/create', [
        'as' => 'admin.traccar.token.create',
        'uses' => 'TokenController@create',
        'middleware' => 'can:traccar.tokens.create'
    ]);
    $router->post('/', [
        'as' => 'admin.traccar.token.store',
        'uses' => 'TokenController@store',
        'middleware' => 'can:traccar.tokens.create'
    ]);
    $router->get('/{token}/edit', [
        'as' => 'admin.traccar.token.edit',
        'uses' => 'TokenController@edit',
        'middleware' => 'can:traccar.tokens.edit'
    ]);
    $router->put('/{token}', [
        'as' => 'admin.traccar.token.update',
        'uses' => 'TokenController@update',
        'middleware' => 'can:traccar.tokens.edit'
    ]);
    $router->delete('/{token}', [
        'as' => 'admin.traccar.token.destroy',
        'uses' => 'TokenController@destroy',
        'middleware' => 'can:traccar.tokens.destroy'
    ]);

});

// append

});
