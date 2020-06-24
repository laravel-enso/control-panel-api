<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\Cache;
use LaravelEnso\Helpers\Classes\Decimals;
use LaravelEnso\Helpers\Classes\Obj;

class RequestMonitor extends Sensor
{
    public const RequestMonitor = 'control-panel-api:requestMonitor';

    private array $hits;

    public function __construct(Obj $obj)
    {
        parent::__construct($obj);

        $this->hits = Cache::get(static::RequestMonitor, []);
    }

    public function value()
    {
        return "{$this->avgResponseTime()} ms";
    }

    public function tooltip(): string
    {
        $count = count($this->hits);

        return "average response time for the last {$count} requests";
    }

    public function icon(): array
    {
        return ['fad', 'stopwatch'];
    }

    public function order(): int
    {
        return 600;
    }

    private function avgResponseTime(): string
    {
        return ! empty($this->hits)
            ? Decimals::div(array_sum($this->hits), count($this->hits))
            : 0;
    }
}
