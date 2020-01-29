<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ResponseTime as Sensor;

class ResponseTime
{
    public function handle($request, Closure $next)
    {
        $start = microtime(true);

        $response = $next($request);

        $time = microtime(true) - $start;

        Cache::forever(Sensor::TIME_KEY, Cache::get(Sensor::TIME_KEY) + $time);
        Cache::increment(Sensor::REQUEST_KEY);

        return $response;
    }
}
