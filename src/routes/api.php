<?php

Route::group([
    'namespace' => 'LaravelEnso\ControlPanelApi\app\Http\Controllers',
    //'middleware' => ['auth:api'], // - for passport personal access token or old style api_token
    'middleware' => ['passport'], // - for passport client credentials
    'prefix'     => 'api/v1',
    'as'         => 'api.v1.', ],
    function () {
        Route::get('statistics', 'ControlPanelApiController@getStatistics')->name('statistics');
        Route::delete('clearLaravelLog', 'ControlPanelApiController@clearLaravelLog')->name('clearLaravelLog');
        Route::delete('token', 'ControlPanelApiController@deleteOauthToken')->name('deleteOauthToken');
        Route::post('setMaintenanceMode', 'ControlPanelApiController@setMaintenanceMode')->name('setMaintenanceMode');
    });
