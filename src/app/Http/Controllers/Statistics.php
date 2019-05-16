<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\app\Http\Responses\StatisticsResponse;

class Statistics extends Controller
{
    public function __invoke()
    {
        return new StatisticsResponse();
    }
}
