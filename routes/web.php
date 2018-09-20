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

Route::resource('dashboard', 'DashboardController')->only('index');
Route::resource('activity', 'ActivityController')->except(['create', 'show', 'edit']);
Route::post('activity/submit', 'ActivityController@submitPost')->name('activity.submit');

Route::resource('partner', 'PartnerController')->except(['create','edit','show','destroy']);
Route::get('partner/akses-true', 'PartnerController@aksesSubmitTrue');
Route::get('partner/akses-false', 'PartnerController@aksesSubmitFalse');

Route::resource('profile', 'ProfileController');
Route::get('profile/siap', function () {
	return 'siap';
});