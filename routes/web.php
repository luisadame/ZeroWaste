<?php

Route::get('/', 'LandingPageController');
Route::get('/food', 'FoodController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
