<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\Api\Http\Middleware\ApiLogger;
use LaravelEnso\ControlPanelApi\Commands\Monitor;
use LaravelEnso\ControlPanelApi\Http\Middleware\RequestMonitor;
use LaravelEnso\ControlPanelApi\Services\Actions;
use LaravelEnso\ControlPanelApi\Services\Statistics;
use LaravelEnso\Core\Http\Middleware\VerifyActiveState;
use LaravelEnso\Localisation\Http\Middleware\SetLanguage;
use LaravelEnso\Permissions\Http\Middleware\VerifyRouteAccess;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        'statistics' => Statistics::class,
        'actions' => Actions::class,
    ];

    public function boot()
    {
        $this->command()
            ->publish()
            ->load();
    }

    public function register()
    {
        $this->app['router']
            ->aliasMiddleware('request-monitor', RequestMonitor::class);

        $this->app['router']->middlewareGroup('control-panel-api', [
            VerifyActiveState::class,
            ApiLogger::class,
            VerifyRouteAccess::class,
            SetLanguage::class,
        ]);
    }

    private function command(): self
    {
        $this->commands(Monitor::class);

        $this->app->booted(fn () => $this->app->make(Schedule::class)
            ->command('enso:control-panel-api:monitor')->everyFiveMinutes());

        return $this;
    }

    private function publish(): self
    {
        $this->publishes([
            __DIR__.'/../database/seeds' => database_path('seeds'),
        ], ['control-panel-api-seeder', 'enso-seeders']);

        return $this;
    }

    private function load()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
