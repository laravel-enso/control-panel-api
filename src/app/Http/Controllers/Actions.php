<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Facades\Actions as Facade;
use LaravelEnso\ControlPanelApi\App\Http\Responses\Action as Response;

class Actions extends Controller
{
    public function __invoke(Request $request)
    {
        return Response::collection(Facade::all());
    }
}
