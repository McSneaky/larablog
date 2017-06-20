<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$locale = Request::segment(1);

if (in_array($locale, Config::get('app.available_locales'))) {
    \App::setLocale($locale);
} else {
    $locale = null;
}


Auth::routes();

Route::group(array('prefix' => $locale), function()
{
	Route::get('/', function () {
	    return view('welcome');
	})->name('root');

	Route::get('/home', 'HomeController@index')->name('home');

	// Posts routes
	Route::get('posts', 'PostsController@index')->name('posts');
	Route::get('/post/create', 'PostsController@create')->name('post_create');
	Route::get('/post/edit/{id}', 'PostsController@edit')->name('post_edit');
	Route::get('/post/{id}', 'PostsController@show')->name('post_show');
	
	Route::post('/post/edit/{id}', 'PostsController@update');
	Route::post('/post/create', 'PostsController@store');
	Route::get('/post/delete/{id}', 'PostsController@destroy')->name('post_delete');

	// Comment routes
	Route::post('/comment/{id}', 'CommentsController@store');

	// Image routes
	Route::get('/image/delete/{id}', 'PostsController@removeImage')->name('img_delete');

	// User routes
	Route::post('/user/edit/{id}', 'UsersController@update')->name('user_edit');
	Route::get('/user/delete/{id}', 'UsersController@destroy')->name('user_delete');
});