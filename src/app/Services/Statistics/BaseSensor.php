<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Str;
use LaravelEnso\ControlPanelApi\App\Contracts\Sensor;
use LaravelEnso\Helpers\App\Classes\Obj;
use ReflectionClass;

abstract class BaseSensor implements Sensor
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

    public function description(): ?string
    {
        return null;
    }

    public function class(): string
    {
        return '';
    }

    public function order(): int
    {
        return 0;
    }

    protected function filter($query, $attribute = 'created_at')
    {
        return $query->when(
            $this->params->filled('startDate'), fn ($query) => $query
            ->where($attribute, '>=', $this->params->get('startDate'))
        )->when(
            $this->params->filled('endDate'), fn ($query) => $query
            ->where($attribute, '<=', $this->params->get('endDate'))
        );
    }
}
