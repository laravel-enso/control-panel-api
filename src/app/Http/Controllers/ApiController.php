<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelEnso\LogManager\app\Http\Services\LogService;
use LaravelEnso\ControlPanelApi\app\Http\Responses\StatisticsResponse;

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
        (new LogService())->empty(self::LogFile);

        return json_encode(['logSize' => 0]);
    }
}
