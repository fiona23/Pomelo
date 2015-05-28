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

Route::post('upload/add',[ 
        'as' => 'addentry', 'uses' => 'UploadController@store']);

Route::resource('people', 'PeopleController');

Route::filter('csrf', function()
{
   $token = Request::header('X-CSRF-Token') ?: Input::get('_token');
   if (Session::token() !== $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});