<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', 'DashboardController@home')->name('home');

Route::group([
    'prefix' => 'providers',
], function () {
    Route::get('', 'ProvidersController@showProviders')->name('providers.show');
    Route::get('register', 'ProvidersController@register')->name('providers.register');
    Route::get('delete/{provider}/ask', 'ProvidersController@deleteConfirmation')->name('providers.deleteConfirmation');
    Route::get('delete/{provider}', 'ProvidersController@deleteProvider')->name('providers.deleteProvider');
});

Route::group([
    'prefix' => 'works',
], function () {
    Route::get('history', 'WorksController@history')->name('works.history');
    Route::get('post', 'WorksController@postPage')->name('works.post');
    Route::post('post', 'WorksController@postWork')->name('works.postWork');
    Route::get('delete/{artwork}/ask', 'WorksController@deleteConfirmation')->name('works.deleteConfirmation');
    Route::post('delete/{artwork}', 'WorksController@deleteWork')->name('works.deleteWork');
    Route::get('delete/{artwork}/permanently', 'WorksController@deletePermanently')->name('works.deletePermanently');
});

Route::group([
    'prefix' => 'scheduled',
], function () {
    Route::get('', 'ScheduledController@showScheduled')->name('scheduled.show');
    Route::get('delete/{scheduled}/ask', 'ScheduledController@deleteConfirmation')->name('scheduled.deleteConfirmation');
    Route::get('delete/{scheduled}/permanently', 'ScheduledController@deletePermanently')->name('scheduled.deletePermanently');
});
