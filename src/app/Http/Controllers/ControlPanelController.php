<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Controllers;

use App\Http\Controllers\Controller;

class ControlPanelController extends Controller
{
    public function __invoke()
    {
        return view('laravel-enso/controlpanelapi::index');
    }
}
