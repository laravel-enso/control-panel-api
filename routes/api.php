<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\ControlPanelApi\Http\Controllers')
    ->group(function () {
        Route::middleware(['api', 'auth:sanctum'])
            ->prefix('api/controlPanelApi')
            ->as('api.controlPanelApi.')
            ->group(function () {
                Route::get('statistics', 'Statistics')->name('statistics');
                Route::get('actions', 'Actions')->name('actions');
                Route::any('{action}', 'Action')->name('action');
            });

        Route::middleware(['signed', 'bindings'])
            ->prefix('api/controlPanelApi/action')
            ->as('api.controlPanelApi.action.')
            ->group(fn () => Route::get('downloadLog', 'DownloadLog')->name('downloadLog'));
    });
