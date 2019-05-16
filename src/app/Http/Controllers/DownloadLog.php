<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use Illuminate\Routing\Controller;

class DownloadLog extends Controller
{
    public function __invoke()
    {
        $headers = ['Content-Type: application/log'];

        return response()->download(
            storage_path('logs/laravel.log'), 'laravel.log', $headers
        );
    }
}
