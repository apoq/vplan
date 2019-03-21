<?php

$route->get('/', 'App\Controllers\FrontController@index');
$route->get('/plans', 'App\Controllers\FrontController@plans');
$route->get('/users', 'App\Controllers\FrontController@users');
$route->get('/widgets/users/{id}', 'App\Controllers\WidgetController@ajaxUser');

$route->group('/api/v1', function() {
    $this->get('/users', 'App\Controllers\Api\UserController@index');
    $this->get('/users/{id}', 'App\Controllers\Api\UserController@view');
    $this->post('/users', 'App\Controllers\Api\UserController@create');
    $this->put('/users/{id}', 'App\Controllers\Api\UserController@update');
    $this->delete('/users/{id}', 'App\Controllers\Api\UserController@delete');
});