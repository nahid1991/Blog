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

interface BarInterface{}

class Bar implements BarInterface{}

App::bind('BarInterface', 'Bar');


Route::get('bar', function(BarInterface $bar)
{
    App::make('BarInterface');

    dd($bar);
});


Route::get('/', function()
{
    return 'Home Page';
});


Route::get('about', 'PagesController@about');

Route::get('contact', 'PagesController@contact');

//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//Route::get('articles/{id}', 'ArticlesController@show');
//Route::get('articles', 'ArticlesController@store');
//Route::get('articles/{id}/edit', 'ArticlesController@edit');

Route::resource('articles', 'ArticlesController');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('foo', ['middleware' => 'manager', function()
{
    return 'This page only be viewed by a manager';
}]);

Route::get('tags/{tags}', 'TagsController@show');