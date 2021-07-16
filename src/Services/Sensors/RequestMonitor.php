<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Facades\Cache;
use LaravelEnso\Helpers\Services\Decimals;
use LaravelEnso\Helpers\Services\Obj;

class RequestMonitor extends Sensor
{
    public const RequestMonitorKey = 'control-panel-api:request-monitor';

    private array $hits;

    public function __construct(Obj $params)
    {
        parent::__construct($params);

        $this->hits = Cache::get(static::RequestMonitorKey, []);
    }

    public function value(): mixed
    {
        return "{$this->avgResponseTime()} ms";
    }

    public function tooltip(): string
    {
        $count = number_format(count($this->hits));

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
        return empty($this->hits)
            ? 0
            : Decimals::div(array_sum($this->hits), count($this->hits), 0);
    }
}
