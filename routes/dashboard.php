<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', 'DashboardController@home')->name('home');

Route::group([
    'prefix' => 'providers',
], function () {
    Route::get('', 'ProvidersController@showProviders')->name('providers.show');
    Route::get('register', 'ProvidersController@register')->name('providers.register');
});

Route::group([
    'prefix' => 'works',
], function () {
    Route::get('history', 'WorksController@history')->name('works.history');
    Route::get('post', 'WorksController@post')->name('works.post');
});
