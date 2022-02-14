<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\CustomersController;

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

$router->group(['prefix' => 'customers'], function () use ($router) {
    $router->get('/', 'CustomersController@index');
    $router->post('/', 'CustomersController@create');
    $router->get('/{id}', 'CustomersController@getCustomer');
});

$router->group(['prefix' => 'transaction'], function () use ($router) {
    $router->post('/create_transaction', 'PurchaseController@create');
    $router->get('/check_customer/{id}', 'PurchaseController@check');
    $router->post('/upload_photo/{id}', 'PurchaseController@upload_photo');
});
