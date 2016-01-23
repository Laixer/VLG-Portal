<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
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
    Route::get('/user/application/remove', 'AdminController@removeApplication');
    Route::get('/companies', 'AdminController@companies');
    Route::get('/company/new', 'AdminController@newCompany');
    Route::get('/company/edit', 'AdminController@editCompany');
    Route::get('/sessions', 'AdminController@sessions');
    Route::get('/applications', 'AdminController@applications');
    Route::get('/application/new', 'AdminController@newApplication');
});
