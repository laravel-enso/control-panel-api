<?php

namespace LaravelEnso\ControlPanelApi\app\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use LaravelEnso\ControlPanelApi\app\Classes\Statistics;

class StatisticsResponse implements Responsable
{
    public function toResponse($request)
    {
        $stats = (new Statistics($request->all()))->get();

        if (is_null($stats)) {
            return response('Invalid dataType(s) requested', 500);
        }

        return $stats;
    }
}
