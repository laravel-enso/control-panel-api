<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Str;
use LaravelEnso\ControlPanelCommon\Contracts\Sensor as Contract;
use LaravelEnso\Helpers\Classes\Obj;
use ReflectionClass;

abstract class Sensor implements Contract
{
    private Obj $params;

    public function __construct(Obj $params)
    {
        $this->params = $params;
    }

    public function id()
    {
        return Str::camel((new ReflectionClass($this))->getShortName());
    }

    public function class(): string
    {
        return '';
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
