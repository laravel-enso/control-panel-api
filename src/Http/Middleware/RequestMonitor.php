<?php

namespace LaravelEnso\ControlPanelApi\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use LaravelEnso\ControlPanelApi\Services\Sensors\RequestMonitor as Sensor;

class RequestMonitor
{
    private const RequestLimit = 10000;

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $time = microtime(true) - LARAVEL_START;

        $hits = Cache::get(Sensor::RequestMonitorKey, []);

        if (count($hits) === self::RequestLimit) {
            array_shift($hits);
        }

        $hits[] = $time * 1000;

        Cache::forever(Sensor::RequestMonitorKey, $hits);

        return $response;
    }
}
