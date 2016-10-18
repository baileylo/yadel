<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/** @var \Illuminate\Routing\Router $router */

$router->get('/recipe/{recipe}', 'RecipeController@show');
$router->get('/add-recipe', 'RecipeController@create');
$router->post('/add-recipe', 'RecipeController@save');
