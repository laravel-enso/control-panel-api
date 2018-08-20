<?php

Route::namespace('LaravelEnso\ControlPanelApi\app\Http\Controllers')
    ->middleware(['passport'])
    ->prefix('api/v2')->as('api.v2.')
    ->group(function () {
        Route::get('statistics', 'ApiController@statistics')->name('statistics');
        Route::delete('clearLaravelLog', 'ApiController@clearLaravelLog')->name('clearLaravelLog');
        Route::delete('token', 'ApiController@destroyToken')->name('destroyToken');
        Route::post('setMaintenanceMode', 'ApiController@setMaintenanceMode')->name('setMaintenanceMode');
    });
