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

Route::get('/login', 'AuthController@loginForm');
Route::post('/login', 'AuthController@doLogin');
Route::get('/logout', 'AuthController@doLogout');

Route::get('/', 'HomeController@index');
Route::get('/faq', 'HomeController@faq');
Route::get('/account', 'HomeController@account');
Route::get('/log', 'HomeController@log');
Route::get('/company', 'HomeController@company');

Route::get('/password/reset/{token}', 'ResetController@passwordResetForm');
Route::post('/password/reset/{token}', 'ResetController@doNewPassword');
Route::get('/password/reset', 'ResetController@forgotPassword');
Route::post('/password/reset', 'ResetController@sendResetMail');

Route::post('/account', 'HomeController@accountUpdate');
