<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use LaravelEnso\ActionLogger\App\Models\ActionLog;
use LaravelEnso\ControlPanelApi\App\Enums\DataTypes;
use LaravelEnso\Core\App\Models\Login;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Helpers\App\Classes\Decimals;
use LaravelEnso\Helpers\App\Classes\Obj;

class Statistics
{
    public function __construct($params)
    {
        $this->params = $this->params($params);
    }

    public function handle()
    {
        return $this->requestIsValid()
            ? $this->statistics()
            : null;
    }

    private function statistics()
    {
        return $this->params->get('dataTypes')
            ->map(fn ($type) => Str::camel($type))
            ->reduce(fn ($response, $type) => $response
                ->put($type, $this->{$type}), new Collection());
    }

    private function logins()
    {
        return $this->filter(Login::query())->count();
    }

    private function actions()
    {
        return $this->filter(ActionLog::query())->count();
    }

    private function users()
    {
        return User::count();
    }

    private function activeUsers()
    {
        return User::active()->count();
    }

    private function newUsers()
    {
        return $this->filter(User::query())->count();
    }

    private function failedJobs()
    {
        return $this->filter(
            DB::table('failed_jobs')->selectRaw('id'), 'failed_at'
        )->count();
    }

    private function sessions()
    {
        return DB::table('sessions')
            ->selectRaw('user_id')
            ->count();
    }

    private function serverTime()
    {
        return Carbon::now()->format('H:i');
    }

    private function logSize()
    {
        $size = File::size(storage_path('logs/laravel.log'));

        return Decimals::div($size, 1024 * 1024);
    }

    private function version()
    {
        return config('enso.config.version');
    }

    private function status()
    {
        return app()->isDownForMaintenance() ? 'down' : 'up';
    }

    private function filter($query, $attribute = 'created_at')
    {
        return $query->when(
            $this->params->filled('startDate'), fn ($query) => $query
                ->where($attribute, '>=', $this->params->get('startDate'))
        )->when(
            $this->params->filled('endDate'), fn ($query) => $query
                ->where($attribute, '<=', $this->params->get('endDate'))
        );
    }

    private function requestIsValid()
    {
        return $this->params->get('dataTypes')
            ->diff(DataTypes::keys())
            ->isEmpty();
    }

    private function params(array $params)
    {
        $params['dataTypes'] = json_decode($params['dataTypes']);

        return new Obj($params);
    }
}
