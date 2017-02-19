<?php

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
use Illuminate\Support\Facades\DB;
$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/api/login', 'AuthController@login');
$app->post('/api/login', 'AuthController@login');
$app->group([
    'prefix' => 'ru',
    'middleware' => 'auth:api',
], function () use ($app){
    $app->get('logout', 'AuthController@logout');
    $app->get('/test', function () {
        return '恭喜您认证成功';
    });
});
