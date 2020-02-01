<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Facades\Cache;
use LaravelEnso\Helpers\App\Classes\Decimals;
use LaravelEnso\Helpers\App\Classes\Obj;

class ResponseTime extends Sensor
{
    public const ResponseTimeMonitor = 'control-panel-api:responseTimeMonitor';

    private array $hits;

    public function __construct(Obj $obj)
    {
        parent::__construct($obj);

        $this->hits = Cache::get(static::ResponseTimeMonitor, []);
    }

    public function value()
    {
        return "{$this->avgResponseTime()} ms";
    }

    public function tooltip(): string
    {
        $count = count($this->hits);

        return "average response time for {$count} requests in the last hour";
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
