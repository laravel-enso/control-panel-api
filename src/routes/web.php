<?php

Route::group([
    'namespace' => 'LaravelEnso\ControlPanelApi\app\Http\Controllers',
    'middleware' => ['passport'],
    'prefix' => 'api/v1',
    'as' => 'api.v1.',
], function () {
    Route::get('statistics', 'ApiController@getStatistics')->name('statistics');
    Route::delete('clearLaravelLog', 'ApiController@clearLaravelLog')->name('clearLaravelLog');
    Route::delete('token', 'ApiController@deleteOauthToken')->name('deleteOauthToken');
    Route::post('setMaintenanceMode', 'ApiController@setMaintenanceMode')->name('setMaintenanceMode');
});
