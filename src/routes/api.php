<?php

Route::group([
    'namespace' => 'LaravelEnso\StatisticsManager\app\Http\Controllers',
    'middleware' => ['auth:api'],
    'prefix' => 'api',
    'as' => 'api.'],
    function () {
        Route::get('statistics', 'StatisticsController@getStatistics')->name('statistics');
});
