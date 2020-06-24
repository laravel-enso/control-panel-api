<?php

namespace LaravelEnso\ControlPanelApi\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\Facades\Actions as Facade;
use LaravelEnso\ControlPanelCommon\Http\Resources\Action as Response;

class Actions extends Controller
{
    public function __invoke()
    {
        return Response::collection(Facade::all());
    }
}
