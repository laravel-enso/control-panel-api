<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\Cache;
use LaravelEnso\Helpers\App\Classes\Decimals;

class ResponseTime extends BaseSensor
{
    public const TIME_KEY = 'control-panel-api:response_time';
    public const REQUEST_KEY = 'control-panel-api:request_count';

    public function value()
    {
        return number_format($this->avgResponseTime()).' ms';
    }

    public function tooltip(): string
    {
        return 'response time';
    }

    public function description(): ?string
    {
        return 'average response time in millisecond';
    }

    public function icon()
    {
        return ['fad', 'stopwatch'];
    }

    /**
     * @return string
     */
    private function avgResponseTime(): string
    {
        $avg = Decimals::div(Cache::get(static::TIME_KEY), Cache::get(static::REQUEST_KEY), 3);

        return Decimals::mul($avg, 1000, 0);
    }
}
