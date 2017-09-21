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

Route::get('/', 'WallsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController', array('except' => ['store', 'index', 'create']));

Route::get('/avatars/{id}/{size}', 'ImageController@createAvatar');

Route::get('/search', 'SearchController@searchUsers');

Route::get('/users/{user}/friends', 'FriendsController@index');
Route::post('/friends/{id}', 'FriendsController@add');
Route::patch('/friends/{id}', 'FriendsController@accept');
Route::delete('/friends/{id}', 'FriendsController@delete');

Route::resource('posts', 'PostsController', array('except' => ['index', 'create']));

Route::resource('/comments', 'CommentsController', array('except' => ['index', 'show', 'create']));

Route::post('/likes', 'LikesController@add');
Route::delete('/likes', 'LikesController@destroy');
