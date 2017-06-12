<?php

Route::group([
    'namespace' => 'LaravelEnso\StatisticsManager\app\Http\Controllers',
    //'middleware' => ['auth:api'], // - for passport personal access token or old style api_token
    'middleware' => ['passport'], // - for passport client credentials
    'prefix'     => 'api',
    'as'         => 'api.', ],
    function () {
        Route::get('statistics', 'StatisticsController@getStatistics')->name('statistics');
    });
