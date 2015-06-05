<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('welcome', 'WelcomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/', 'AdminHomeController@index');
    Route::resource('pages', 'PagesController');
});

Route::get('upload', 'UploadController@index');
Route::post('upload', 'UploadController@index');
Route::post('upload/add', 'UploadController@store');
Route::resource('people', 'PeopleController');
//嵌套资源控制器 处理想要交换的明信片
Route::resource('people.exchange', 'ExchangeController');
//保存评论
Route::post('comment/store', 'PostcardCommentController@store');
//交换
Route::post('exchange/sure', 'ExchangeController@store');

Route::post('exchange/showList', 'ExchangeController@showList');
//确认交换
Route::post('exchange/choose', 'ExchangeController@choose');
//
Route::get('exchange/sure', 'ExchangeController@sure');
//
Route::get('account', 'UserController@index');
Route::post('account', 'UserController@store');
//处理ajax
Route::filter('csrf', function()
{
   $token = Request::header('X-CSRF-Token') ?: Input::get('_token');
   if (Session::token() !== $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});