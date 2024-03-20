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
$router->group(['prefix' => 'traccar/auth'], function (Router $router) {
    # Login
    $router->get('login', ['middleware' => 'auth.guest', 'as' => 'traccar.login', 'uses' => 'AuthController@getLogin']);
    $router->post('login', ['as' => 'traccar.login.post', 'uses' => 'AuthController@postLogin']);
    # Register
    if (config('encore.user.config.allow_user_registration', true)) {
        $router->get('register', ['middleware' => 'auth.guest', 'as' => 'traccar.register', 'uses' => 'AuthController@getRegister']);
        $router->post('register', ['as' => 'traccar.register.post', 'uses' => 'AuthController@postRegister']);
    }
    # Account Activation
    $router->get('activate/{userId}/{activationCode}', 'AuthController@getActivate');
    # Reset password
    $router->get('reset', ['as' => 'traccar.reset', 'uses' => 'AuthController@getReset']);
    $router->post('reset', ['as' => 'traccar.reset.post', 'uses' => 'AuthController@postReset']);
    $router->get('reset/{id}/{code}', ['as' => 'reset.complete', 'uses' => 'AuthController@getResetComplete']);
    $router->post('reset/{id}/{code}', ['as' => 'reset.complete.post', 'uses' => 'AuthController@postResetComplete']);
    # Logout
    $router->get('logout', ['as' => 'traccar.logout', 'uses' => 'AuthController@getLogout']);
});


