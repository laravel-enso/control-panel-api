<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\ControlPanelApi\App\Http\Controllers')
    ->middleware(['auth:api'])
    ->prefix('token')->as('token.')
    ->group(function () {
        Route::get('statistics', 'Statistics')->name('statistics');
        Route::post('downloadLog', 'DownloadLog')->name('downloadLog');
        Route::post('clearLog', 'ClearLog')->name('clearLog');
        Route::post('maintenance', 'Maintenance')->name('maintenance');
    });
