<?php

// FRONT
$route->get('/', 'App\Controllers\FrontController@index');
$route->get('/plans', 'App\Controllers\FrontController@plans');
$route->get('/plans/{id}', 'App\Controllers\FrontController@plan');
$route->get('/plan_create', 'App\Controllers\FrontController@createPlan');
$route->get('/users', 'App\Controllers\FrontController@users');
$route->get('/widgets/users/{id}', 'App\Controllers\WidgetController@ajaxUser');

// API
$route->group('/api/v1', function() {
    $this->group('/users', function () {
        $this->get('/', 'App\Controllers\Api\UserController@index');
        $this->get('/{id}', 'App\Controllers\Api\UserController@view');
        $this->post('/', 'App\Controllers\Api\UserController@create');
        $this->put('/{id}', 'App\Controllers\Api\UserController@update');
        $this->delete('/{id}', 'App\Controllers\Api\UserController@delete');
    });
    $this->group('/plans', function () {
        $this->get('/', 'App\Controllers\Api\PlanController@index');
        $this->get('/{id}', 'App\Controllers\Api\PlanController@view');
        $this->post('/', 'App\Controllers\Api\PlanController@create');
        $this->put('/{id}', 'App\Controllers\Api\PlanController@update');
        $this->delete('/{id}', 'App\Controllers\Api\PlanController@delete');
        $this->post('/{id}/users', 'App\Controllers\Api\PlanController@addPlanUser');
        $this->delete('/{id}/users/{userId}', 'App\Controllers\Api\PlanController@deletePlanUser');
    });
    $this->group('/days', function () {
        $this->get('/', 'App\Controllers\Api\DayController@index');
        $this->get('/{id}', 'App\Controllers\Api\DayController@view');
        $this->post('/', 'App\Controllers\Api\DayController@create');
        $this->put('/{id}', 'App\Controllers\Api\DayController@update');
        $this->delete('/{id}', 'App\Controllers\Api\DayController@delete');
    });
    $this->group('/exercises', function () {
        $this->get('/', 'App\Controllers\Api\ExerciseController@index');
        $this->get('/{id}', 'App\Controllers\Api\ExerciseController@view');
        $this->post('/', 'App\Controllers\Api\ExerciseController@create');
        $this->put('/{id}', 'App\Controllers\Api\ExerciseController@update');
        $this->delete('/{id}', 'App\Controllers\Api\ExerciseController@delete');
    });

});