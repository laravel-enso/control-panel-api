<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelEnso\ControlPanelApi\app\Http\Responses\StatisticsResponse;
use LaravelEnso\LogManager\app\Classes\Destroyer;

class ApiController extends Controller
{
    private const LogFile = 'laravel.log';

    public function statistics(Request $request)
    {
        return new StatisticsResponse();
    }

    public function maintenance()
    {
        if (app()->isDownForMaintenance()) {
            \Artisan::call('up');
            $response = ['status' => 'up'];
        } else {
            \Artisan::call('down');
            $response = ['status' => 'down'];
        }

        return json_encode($response);
    }

    public function clearLog()
    {
        $log = (new Destroyer(self::LogFile))
            ->run();

        return json_encode(['logSize' => 0]);
    }
}
