<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\App\Services\ClearLog as Service;

class ClearLog extends Controller
{
    private const LogFile = 'laravel.log';

    public function __invoke()
    {
        (new Service(self::LogFile))->handle();

        return json_encode(['logSize' => 0]);
    }
}
