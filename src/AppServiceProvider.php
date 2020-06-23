<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\App\Commands\Monitor;
use LaravelEnso\ControlPanelApi\App\Http\Middleware\RequestMonitor;
use LaravelEnso\ControlPanelApi\App\Services\Actions;
use LaravelEnso\ControlPanelApi\App\Services\Statistics;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        'statistics' => Statistics::class,
        'actions' => Actions::class,
    ];

    public function boot()
    {
        $this->middleware()
            ->command()
            ->publish()
            ->load();
    }

    private function command(): self
    {
        $this->commands(Monitor::class);

        $this->app->booted(fn () => $this->app->make(Schedule::class)
            ->command('enso:control-panel-api:monitor')->everyFiveMinutes());

        return $this;
    }

    private function middleware(): self
    {
        $this->app['router']
            ->aliasMiddleware('request-monitor', RequestMonitor::class);

        return $this;
    }

    private function publish(): self
    {
        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds'),
        ], ['control-panel-api-seeder', 'enso-seeders']);

        return $this;
    }

    private function load()
    {
        $this ->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
