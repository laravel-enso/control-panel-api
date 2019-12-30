<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;

class DownloadLog extends Controller
{
    public function __invoke()
    {
        return response()->download(
            storage_path('logs/laravel.log'), 'laravel.log', ['Content-Type: application/log']
        );
    }
}
