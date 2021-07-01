<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\LoginController@login')->name('login.api');
Route::post('/register','Auth\RegisterController@register')->name('register.api');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout.api');

Route::get('short_links/list', 'ShorterLinkController@list')->middleware('my.auth');
Route::post('short_links/create', 'ShorterLinkController@create')->middleware('my.auth');
Route::delete('short_links/{code}', 'ShorterLinkController@delete')->middleware('my.auth');
