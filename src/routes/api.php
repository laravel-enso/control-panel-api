<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\ControlPanelApi\App\Http\Controllers')
    ->group(function () {
        Route::middleware(['auth:api'])
            ->prefix('token')
            ->as('token.')
            ->group(function () {
                Route::get('statistics', 'Statistics')->name('statistics');
                Route::get('actions', 'Actions')->name('actions');
                Route::any('{action}', 'Action')->name('action');
            });

        Route::middleware(['signed', 'bindings'])
            ->prefix('api/controlPanelApi')
            ->as('api.controlPanelApi.')
            ->group(fn () => Route::get('downloadLog', 'DownloadLog')->name('downloadLog'));
    });
