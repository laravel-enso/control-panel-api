<?php

Route::group([
    'namespace' => 'LaravelEnso\StatisticsManager\app\Http\Controllers',
    //'middleware' => ['auth:api'], // - for passport personal access token or old style api_token
    'middleware' => ['passport', 'throttle:1'], // - for passport client credentials
    'prefix'     => 'api/v1',
    'as'         => 'api.v1.', ],
    function () {
        Route::get('statistics', 'StatisticsController@getStatistics')->name('statistics');
        Route::delete('clearLaravelLog', 'StatisticsController@clearLaravelLog')->name('clearLaravelLog');
        Route::delete('token', 'StatisticsController@deleteOauthToken')->name('deleteOauthToken');
    });
