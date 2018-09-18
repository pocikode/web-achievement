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
    return view('pages.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dashboard', 'DashboardController')->only('index');
Route::resource('activity', 'ActivityController')->except(['create', 'show', 'edit']);
Route::get('activity/submit', 'ActivityController@submit');
Route::post('activity/submit', 'ActivityController@submitPost')->name('activity.submit');

Route::get('tanggal', function () {
	return date('Y-m-d');
});