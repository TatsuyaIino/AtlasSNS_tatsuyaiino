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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::post('/top','PostsController@index');
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');
Route::get('/otherProfile/{id}','UsersController@otherProfile');

Route::get('/search','UsersController@index');
Route::post('/search','UsersController@search');

Route::get('/follow/{id}', 'UsersController@follow');
Route::get('/unFollow/{id}', 'UsersController@unFollow');

Route::post('/update','UsersController@update');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

Route::post('/post','PostsController@post');

Route::post('/edit', 'PostsController@update');
Route::get('/delete/{id}', 'PostsController@delete');
