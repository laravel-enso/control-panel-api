<?php

namespace LaravelEnso\ControlPanelApi\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\Facades\Statistics as Facade;
use LaravelEnso\ControlPanelCommon\Http\Resources\Group;

class Statistics extends Controller
{
    public function __invoke()
    {
        return Group::collection(Facade::all());
    }
}
