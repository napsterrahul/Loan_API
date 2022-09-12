<?php

// Uncomment this line


/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api/'], function ($router) {
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    
    $router->get('login/','UsersController@authenticate');
    $router->post('loan/','LoanController@store');
    $router->get('loan/', 'LoanController@index');
    $router->post('approve/', 'LoanController@approve');
    $router->get('loandetails', 'LoanController@show');
    $router->post('repayment/', 'LoanController@repayment');
});

