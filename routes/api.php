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
//use Illuminate\Support\Facades\DB;
//$app->get('/', function () use ($app) {
//    return $app->version();
//});

//$app->get('/test', function(){
//    $user = \App\Models\User::find(1);
////    $user = DB::select("SELECT * FROM users");
//    dd($user);
//});

//$app->get('/api/login', 'AuthController@login');
//$app->post('/api/login', 'AuthController@login');
//$app->group([
//    'prefix' => 'ru',
//    'middleware' => 'auth:api',
//], function () use ($app){
//    $app->get('logout', 'AuthController@logout');
//    $app->get('/test', function () {
//        return '恭喜您认证成功';
//    });
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  ['namespace' => '\App\Http\Controllers\Api\V1'], function ($api) {
    $api->post('getToken', 'AuthFirstController@login');
    $api->group(['prefix'=>'u' ,'middleware' => 'api.auth'], function ($api) {
        // Endpoints registered here will have the "foo" middleware applied.
        $api->get('home', function(){
            return '恭喜您认证成功,欢迎进入您的个人门户';
        });
        $api->get('userinfo', [
            'as'=>'userinfo.show',
            'uses'=>'AuthFirstController@userinfo',
        ]);
    });
});

//********************************内部使用api
$dispatcher = app('Dingo\Api\Dispatcher');
$app->get('/web', function () use ($dispatcher) {
    $users = $dispatcher->be(Auth::byId(1))->once()->get('api/u/userinfo');
    return view('userinfo')->with('users', $users);
});