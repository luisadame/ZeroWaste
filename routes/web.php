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
        Route::get('/', 'ImageController@show')->name('images.show'); // load
    });

    /** Notifications */
    Route::prefix('notifications')->group(function () {
        Route::get('/', 'NotificationController@index')->name('notifications.index');
        Route::post('/read', 'NotificationController@read')->name('notifications.read');
        Route::get('/readAll', 'NotificationController@readAll')->name('notifications.readAll');
    });
});
