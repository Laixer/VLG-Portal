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

Route::group(['prefix' => 'api/endpoint/v1', 'middleware' => 'jwt.auth'], function () {
    Route::get('/refresh', 'EndpointController@getTokenRefresh');
    Route::get('/user', 'EndpointController@getUser');
    Route::get('/user_type', 'EndpointController@getUserType');
    Route::get('/user_company', 'EndpointController@getUserCompany');
    Route::get('/user_isadmin', 'EndpointController@getUserIsAdmin');
    Route::get('/faqs', 'EndpointController@getAllFaqs');
    Route::get('/users', 'EndpointController@getAllUsers');
    Route::get('/companies', 'EndpointController@getAllCompanies');
    Route::get('/company/{id}/users', 'EndpointController@getAllCompanyUsers');
});
