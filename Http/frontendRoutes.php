<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/devices'], function (Router $router) {

    $router->get('/', [
        'as' => 'traccar.devices.index',
        'uses' => 'DeviceController@index',
        'middleware' => 'auth'
    ]);

    $router->group(['prefix' =>'/{device}'], function (Router $router) {

        $router->get('/', [
            'as' => 'traccar.devices.show',
            'uses' => 'DeviceController@show',
            'middleware' => 'auth'
        ]);
        $router->group(['prefix' =>'/sensors'], function (Router $router) {

            $router->get('/', [
                'as' => 'traccar.sensor.index',
                'uses' => 'SensorController@index',
                'middleware' => 'auth'
            ]);
            $router->get('/{sensor}', [
                'as' => 'traccar.sensor.show',
                'uses' => 'SensorController@show',
                'middleware' => 'auth'
            ]);
        });

    });


});

$router->group(['prefix' =>'/reports'], function (Router $router) {

    $router->get('/', [
        'as' => 'traccar.report.index',
        'uses' => 'ReportController@index',
        'middleware' => 'auth'
    ]);
});


