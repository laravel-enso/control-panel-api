<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as DBBuilder;
use LaravelEnso\ControlPanelCommon\Contracts\Sensor as Contract;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;
use LaravelEnso\Helpers\Services\Obj;

abstract class Sensor extends IdProvider implements Contract
{
    public function __construct(private Obj $params)
    {
    }

    public function class(): ?string
    {
        return null;
    }

    protected function filter(DBBuilder | Builder $query, $attribute = 'created_at'): DBBuilder | Builder
    {
        return $query
            ->when($this->params->filled('startDate'), fn ($query) => $query
                ->where($attribute, '>=', $this->params->get('startDate')))
            ->when($this->params->filled('endDate'), fn ($query) => $query
                ->where($attribute, '<=', $this->params->get('endDate')));
    }
}
