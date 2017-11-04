<?php

use Laravel\Lumen\Routing\Router;

/** @var \Laravel\Lumen\Routing\Router $router */

/************User Login and Sign up***********************/
$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@login');
/************Other Routes******************/
$router->group(
    [
        "prefix" => "api/v1",
        'middleware' => 'guard',
    ],
    function(Router $router) {
        $router->post('/count/{user_id}', 'TimeLineController@getCount');  // Get Timeline & Event Count by User ID

        $router->post('/events/show/{user_id}', 'EventController@read');  // Get Events by UserID

        $router->post('/lines', 'TimeLineController@index');  // Get All Time Lines
        $router->post('/lines/show/{user_id}', 'TimeLineController@read'); // Get TileLines by UserId
        $router->post('/line/read/{id}', 'TimeLineController@show');  // Get Single Timeline
    }
);
