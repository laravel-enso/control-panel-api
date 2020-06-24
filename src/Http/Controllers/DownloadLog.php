<?php

namespace LaravelEnso\ControlPanelApi\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class DownloadLog extends Controller
{
    public function __invoke()
    {
        return Response::download(
            storage_path('logs/laravel.log'),
            'laravel.log',
            ['Content-Type: application/log']
        );
    }
}
