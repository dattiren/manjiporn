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

Route::get('/', 'HomeController@index');

Route::get('/contactus', 'ContactController@form');

Route::post('/contactus/confirm', 'ContactController@confirm');
Route::post('/contactus/complete', 'ContactController@process');

Route::get('/info', function () {
    return view('use_info');
});

Route::get('/movie', 'PlaybackController@index');

Route::get('/category', 'HomeController@category');

Route::get('/search', 'HomeController@search');

Route::get('/signin', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('register');
});

Route::get('/admin/movie/{id}', function () {
    return view('edit_movie');
});
