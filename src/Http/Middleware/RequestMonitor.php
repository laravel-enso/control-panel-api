<?php

namespace LaravelEnso\ControlPanelApi\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use LaravelEnso\ControlPanelApi\Services\Sensors\RequestMonitor as Sensor;

class RequestMonitor
{
    private const RequestLimit = 2000;
    private const CacheLifetime = 2000;

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $time = microtime(true) - LARAVEL_START;

        $hits = Cache::get(Sensor::RequestMonitor, []);

        $hits = array_slice($hits, -self::RequestLimit);

        $hits[] = $time * 1000;
        $duration = Carbon::now()->addHours(self::CacheLifetime);

        Cache::put(Sensor::RequestMonitor, $hits, $duration);

        return $response;
    }
}
