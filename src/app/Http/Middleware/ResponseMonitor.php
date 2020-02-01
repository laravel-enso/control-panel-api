<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\ResponseTime as Sensor;

class ResponseMonitor
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $time = microtime(true) - LARAVEL_START;

        $hits = Cache::get(Sensor::ResponseTimeMonitor, []);

        if (count($hits) > 1000) {
            $hits = array_slice($hits, -1000);
        }

        $hits[] = $time * 1000;

        Cache::put(Sensor::ResponseTimeMonitor, $hits, now()->addHours(1));

        return $response;
    }
}
