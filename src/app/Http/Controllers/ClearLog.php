<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\Logs\app\Services\Destroyer;

class ClearLog extends Controller
{
    private const LogFile = 'laravel.log';

    public function __invoke()
    {
        (new Destroyer(self::LogFile))
            ->run();

        return json_encode(['logSize' => 0]);
    }
}
