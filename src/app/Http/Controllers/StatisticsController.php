<?php

namespace LaravelEnso\StatisticsManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\ActionLogger\app\Models\ActionHistory;
use LaravelEnso\Core\app\Models\Login;

class StatisticsController extends Controller
{
    public function getStatistics()
    {
    	$startDate = \Date::parse(request('startDate'))->format('Y-m-d');
        $endDate   = \Date::parse(request('endDate'))->format('Y-m-d');
        $response   = [];
        $response['logins']  = Login::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();
        $response['actions'] = ActionHistory::where('created_at', '>', $startDate)->where('created_at', '<', $endDate)->count();

        return $response;
    }
}
