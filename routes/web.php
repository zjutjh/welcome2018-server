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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});
use App\Tip;
$router->get('/index', ['middleware' => 'time', function () {
    return view('index');
}]);
$router->get('/', 'RedisController@second_save');
$router->post('/api/main/sid','MainController@searchStudentId');
$router->post('/api/main/detail', 'MainController@searchStudentDetail');
$router->post('/api/main/detail/classmate', 'MainController@getclassmates');
$router->post('/api/main/dormitory','MainController@searchDormitory');
$router->post('/api/main/dormitory/roommate','MainController@getRoommates');
$router->post('/api/main/tips', 'TipsController@showTips');

$router->get('time', function () {
    $tips = Tip::get();
    $index = random_int(0, count($tips) - 1);
   return  view('time', ['tip' => $tips[$index]]);
//    return view('time');
});
