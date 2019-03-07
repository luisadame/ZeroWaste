<?php
Route::get('/', 'LandingPageController')->name('landing');
Route::get('/about', 'ShowAbout')->name('about');
Route::get('/contact', 'ContactController@index')->name('contact');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('inventories', 'InventoryController');
    Route::resource('recipes', 'RecipeController');
    Route::resource('food', 'FoodController');

    /** Images */
    Route::prefix('images')->group(function () {
        Route::post('/', 'ImageController@store')->name('images.store'); // process
        Route::delete('/', 'ImageController@destroy')->name('images.destroy'); // revert
        Route::get('/{image}', 'ImageController@show')->name('images.show'); // load
        Route::get('/{serverId}', 'ImageController@restore')->name('images.restore'); // restore
    });
});
