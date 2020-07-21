<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\ControlPanelApi\Http\Controllers')
    ->name('apis.controlPanel.')
    ->prefix('apis/controlPanel')
    ->group(function () {
        Route::middleware(['api', 'auth:sanctum', 'core-api'])
            ->group(function () {
                Route::get('statistics', 'Statistics')->name('statistics');
                Route::get('actions', 'Actions')->name('actions');
                Route::any('{action}', 'Action')->name('action');
            });

        Route::middleware(['signed', 'bindings'])
            ->prefix('action')
            ->as('action.')
            ->group(fn () => Route::get('downloadLog', 'DownloadLog')->name('downloadLog'));
    });
