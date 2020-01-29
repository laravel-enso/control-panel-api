<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Facades\Actions as Facade;
use LaravelEnso\ControlPanelApi\App\Http\Resources\Action as Response;

class Actions extends Controller
{
    public function __invoke()
    {
        return Response::collection(Facade::all());
    }
}
