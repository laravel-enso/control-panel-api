<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\ControlPanelApi\App\Facades\Statistics as Facade;
use LaravelEnso\Helpers\App\Classes\Obj;

class Statistics implements Responsable
{
    public function toResponse($request)
    {
        $params = new Obj($request->get('params'));

        return (new Collection(Facade::all()))
            ->map(fn ($sensors) => $this->stats($sensors, $params));
    }

    private function stats($sensors, $params)
    {
        return Sensor::collection(
            (new Collection($sensors))
                ->map(fn ($sensor) => $this->sensor($sensor, $params))
        );
    }

    private function sensor($sensor, $params)
    {
        return App::make($sensor, [
            'params' => $params,
        ]);
    }
}
