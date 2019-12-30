<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use LaravelEnso\ControlPanelApi\App\Services\Statistics as Service;

class Statistics implements Responsable
{
    public function toResponse($request)
    {
        $stats = (new Service($request->all()))->handle();

        return $stats === null
            ? response('Invalid dataType(s) requested', 500)
            : $stats;
    }
}
