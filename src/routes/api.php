<?php

Route::namespace('LaravelEnso\ControlPanelApi\app\Http\Controllers')
    ->middleware(['auth:api'])
    ->prefix('token')->as('token.')
    ->group(function () {
        Route::get('statistics', 'Statistics')->name('statistics');
        Route::post('downloadLog', 'DownloadLog')->name('downloadLog');
        Route::post('clearLog', 'ClearLog')->name('clearLog');
        Route::post('maintenance', 'Maintenance')->name('maintenance');
    });
