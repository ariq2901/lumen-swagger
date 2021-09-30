<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;

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

$router->group(['prefix' => 'api'], static function () use ($router) {
    $router->post('/register', 'UserController@register');
    $router->post('/login', 'UserController@login');
    $router->get('/logout', 'UserController@logout');
    $router->get('/profile', 'UserController@userDetail');



    $router->get('/provinsi', 'ProvinsiController@index');
    $router->post('/create-provinsi', 'ProvinsiController@create');
    $router->get('/provinsi/{id}', 'ProvinsiController@show');
    $router->put('/update-provinsi/{id}', 'ProvinsiController@update');
    $router->delete('/delete-provinsi/{id}', 'ProvinsiController@delete');

    $router->get('/kabupaten', 'KabupatenController@index');
    $router->post('/create-kabupaten', 'KabupatenController@create');
    $router->get('/kabupaten/{id}', 'KabupatenController@show');
    $router->put('/update-kabupaten/{id}', 'KabupatenController@update');
    $router->delete('/delete-kabupaten/{id}', 'KabupatenController@delete');
});
