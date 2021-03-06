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
    Route::get('search', 'WorksController@history')->name('works.showsearch');
    Route::post('search', 'WorksController@searchWork')->name('works.searchWork');
    Route::get('sort', 'WorksController@history')->name('works.showSort');
    Route::post('sort', 'WorksController@sortWorks')->name('works.sortWorks');
    Route::get('repost/{artwork}', 'WorksController@repostPage')->name('works.repost');
    Route::post('repost/{artwork}', 'WorksController@repostWork')->name('works.repostWork');
    Route::get('delete/{artwork}/ask', 'WorksController@deleteConfirmation')->name('works.deleteConfirmation');
    Route::post('delete/{artwork}', 'WorksController@deleteWork')->name('works.deleteWork');
    Route::get('delete/{artwork}/permanently', 'WorksController@deletePermanently')->name('works.deletePermanently');
    Route::get('exportCsv', 'WorksController@exportCsv')->name('works.export');
});

Route::group([
    'prefix' => 'scheduled',
], function () {
    Route::get('', 'ScheduledController@showScheduled')->name('scheduled.show');
    Route::get('delete/{scheduled}/ask', 'ScheduledController@deleteConfirmation')->name('scheduled.deleteConfirmation');
    Route::get('delete/{scheduled}/permanently', 'ScheduledController@deletePermanently')->name('scheduled.deletePermanently');
    Route::get('change/{scheduled}', 'ScheduledController@changePage')->name('scheduled.change');
    Route::post('change/{scheduled}', 'ScheduledController@changeScheduled')->name('scheduled.changeScheduled');
});
