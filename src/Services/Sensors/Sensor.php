<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\ControlPanelApi\Services\IdProvider;
use LaravelEnso\ControlPanelCommon\Contracts\Sensor as Contract;
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

    protected function filter($query, $attribute = 'created_at')
    {
        return $query
            ->when($this->params->filled('startDate'), fn ($query) => $query
                ->where($attribute, '>=', $this->params->get('startDate')))
            ->when($this->params->filled('endDate'), fn ($query) => $query
                ->where($attribute, '<=', $this->params->get('endDate')));
    }
}
