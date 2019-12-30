<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Http\Responses\Statistics as Response;

class Statistics extends Controller
{
    public function __invoke()
    {
        return new Response();
    }
}
