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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** Images */
Route::prefix('images')->group(function () {
    Route::post('/', 'ImageController@store')->name('images.store'); // process
    Route::delete('/', 'ImageController@destroy')->name('images.destroy'); // revert
    Route::get('/{image}', 'ImageController@show')->name('images.show'); // load
    Route::get('/{serverId}', 'ImageController@restore')->name('images.restore'); // restore
});
