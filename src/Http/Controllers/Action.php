<?php

namespace LaravelEnso\ControlPanelApi\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\Facades\Actions;

class Action extends Controller
{
    public function __invoke($action)
    {
        return Actions::get($action)->handle();
    }
}
