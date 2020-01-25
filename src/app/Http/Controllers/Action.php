<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\ControlPanelApi\App\Facades\Actions;

class Action extends Controller
{
    public function __invoke($action)
    {
        return Actions::get($action)->handle();
    }
}
