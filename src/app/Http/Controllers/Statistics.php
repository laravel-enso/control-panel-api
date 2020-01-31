<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Facades\Statistics as Facade;
use LaravelEnso\ControlPanelCommon\App\Http\Resources\Group;

class Statistics extends Controller
{
    public function __invoke()
    {
        return Group::collection(Facade::all());
    }
}
