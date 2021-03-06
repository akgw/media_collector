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

Route::middleware(['authentication'])->group(function () {
    Route::get('/', 'TwitterController@index');
    Route::get('/twitter', 'TwitterController@index');
});

Route::get('/oauth/request', 'LoginController@redirectGoogleAuthorization');
Route::get('/oauth/response', 'LoginController@login');

Route::get('/logout', 'LogoutController@logout');
