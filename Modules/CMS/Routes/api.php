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

Route::middleware('auth:api')->get('/cms', function (Request $request) {
    return $request->user();
});

Route::prefix('cms')
    ->name('api.cms.')
    ->group(function() {

    Route::post('tags', 'API\TagController@store')->name('tags');
});
