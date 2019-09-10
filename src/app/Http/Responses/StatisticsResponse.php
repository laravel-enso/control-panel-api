<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use LaravelEnso\ControlPanelApi\app\Services\Statistics;

class StatisticsResponse implements Responsable
{
    public function toResponse($request)
    {
        $stats = (new Statistics($request->all()))->handle();

        return $stats === null
            ? response('Invalid dataType(s) requested', 500)
            : $stats;
    }
}
