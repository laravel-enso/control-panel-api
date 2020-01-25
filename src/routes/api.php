<?php

use Illuminate\Support\Facades\Route;

Route::namespace('LaravelEnso\ControlPanelApi\App\Http\Controllers')
    ->middleware(['auth:api'])
    ->prefix('token')->as('token.')
    ->group(function () {
        Route::get('statistics', 'Statistics')->name('statistics');
        Route::get('actions', 'Actions')->name('actions');
        Route::any('{action}', 'Action')->name('action');
    });

Route::namespace('LaravelEnso\ControlPanelApi\App\Http\Controllers')
    ->prefix('api/controlPanelApi')->as('api.controlPanelApi.')
    ->middleware(['signed', 'bindings'])
    ->group(function () {
        Route::get('downloadLog', 'DownloadLog')->name('downloadLog');
    });
