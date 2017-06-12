<?php

namespace LaravelEnso\StatisticsManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\Core\app\Models\Login;

class StatisticsController extends Controller
{
    /** A valid call is http://enso.dev/api/statistics?api_token=abc&startDate=2017-01-01&endDate=2017-12-01
     * @return array
     */
    public function getStatistics()
    {
        $startDate = \Date::parse(request('startDate'))->format('Y-m-d');
        $endDate = \Date::parse(request('endDate'))->format('Y-m-d');
        $response = [];
        $response['logins'] = Login::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();
        $response['actions'] = ActionLog::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $response;
    }
}
