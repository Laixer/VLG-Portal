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

Route::group(['middleware' => 'web'], function () {
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
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::post('/faq', 'AdminController@newFaqItem');
    Route::post('/session/terminate', 'AdminController@terminateSession');
    Route::post('/user/new', 'AdminController@AddNewUser');
    Route::post('/user/application/add', 'AdminController@addApplication');
    Route::post('/user/edit', 'AdminController@updateUser');
    Route::post('/company/new', 'AdminController@AddNewCompany');
    Route::post('/company/edit', 'AdminController@updateCompany');
    Route::post('/application/new', 'AdminController@AddNewApplication');
    Route::post('/application/delete', 'AdminController@deleteApplication');

    Route::get('/faq/delete', 'AdminController@deleteFaq');
    Route::get('/users', 'AdminController@users');
    Route::get('/log', 'AdminController@log');
    Route::get('/user/new', 'AdminController@newUser');
    Route::get('/user/edit', 'AdminController@editUser');
    Route::get('/user/delete', 'AdminController@deleteUser');
    Route::get('/user/application/remove', 'AdminController@removeApplication');
    Route::get('/companies', 'AdminController@companies');
    Route::get('/company', 'AdminController@companyOverview');
    Route::get('/company/new', 'AdminController@newCompany');
    Route::get('/company/edit', 'AdminController@editCompany');
    Route::get('/company/delete', 'AdminController@deleteCompany');
    Route::get('/sessions', 'AdminController@sessions');
    Route::get('/applications', 'AdminController@applications');
    Route::get('/application/new', 'AdminController@newApplication');
});