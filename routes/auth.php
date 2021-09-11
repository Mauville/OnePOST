<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'register',
    'middleware' => 'web'
], function () {
    Route::get('', 'AuthController@register')->name('register');
    Route::post('', 'AuthController@saveUser')->name('save-user');
});

Route::group([
    'prefix' => 'login',
    'middleware' => 'web'
], function () {
    Route::get('', 'AuthController@login')->name('login');
    Route::post('', 'AuthController@loginUser')->name('login-user');
});

Route::get('/logout', 'AuthController@logout')->name('logout')
    ->middleware(['web']);

Route::group([
    'middleware' => 'web'
], function() {
    Route::get('/google/redirect', 'OAuthController@redirectToGoogle')->name('google');
    Route::get('/google/callback', 'OAuthController@handleGoogleCallback')->name('google.callback');
});
