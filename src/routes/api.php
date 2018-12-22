<?php

Route::namespace('LaravelEnso\ControlPanelApi\app\Http\Controllers')
    ->middleware(['auth:api'])
    ->prefix('token')->as('token.')
    ->group(function () {
        Route::get('statistics', 'ApiController@statistics')
            ->name('statistics');
        Route::post('downloadLog', 'ApiController@downloadLog')
            ->name('downloadLog');
        Route::post('clearLog', 'ApiController@clearLog')
            ->name('clearLog');
        Route::post('maintenance', 'ApiController@maintenance')
            ->name('maintenance');
    });
