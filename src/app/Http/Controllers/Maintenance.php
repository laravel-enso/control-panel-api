<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class Maintenance extends Controller
{
    public function __invoke()
    {
        if (app()->isDownForMaintenance()) {
            Artisan::call('up');

            return json_encode(['status' => 'up']);
        }

        Artisan::call('down');

        return json_encode(['status' => 'down']);
    }
}
