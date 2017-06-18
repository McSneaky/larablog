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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Posts CRED routes
Route::get('/posts', 'PostsController@index');
Route::get('/post/create', 'PostsController@create');
Route::get('/post/edit/{id}', 'PostsController@edit');
Route::post('/post/edit/{id}', 'PostsController@update');
Route::post('/post/create', 'PostsController@store');
Route::get('/post/delete/{id}', 'PostsController@destroy');
Route::get('/post/{id}', 'PostsController@show');