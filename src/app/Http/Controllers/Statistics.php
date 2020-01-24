<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Http\Responses\Statistics as Response;

class Statistics extends Controller
{
    public function __invoke(Request $request)
    {
        return new Response();
    }
}
