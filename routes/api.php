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

Route::group(['middleware' => 'auth:api'], function () {

    /** User routes. */
    Route::get('/auth/user', 'UserController@show');

    /** List routes. */
    Route::resource('/list', 'ListController', ['except' => [
        'edit', 'create'
    ]]);

    /** Item routes. */
    Route::resource('/item', 'ItemController', ['except' => [
        'index', 'show', 'create', 'edit'
    ]]);
});
