<?php

namespace LaravelEnso\ControlPanelApi\app\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\Core\app\Models\Login;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Helpers\app\Classes\Obj;

class Statistics
{
    public function __construct($params)
    {
        $this->params = $this->params($params);
    }

    public function handle()
    {
        return Request::isValid($this->params)
            ? $this->statistics()
            : null;
    }

    private function statistics()
    {
        return collect($this->params->get('dataTypes'))
            ->reduce(function ($response, $type) {
                $attribute = Str::camel($type);
                $response[$attribute] = $this->{$attribute}();

                return $response;
            }, []);
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
            DB::table('failed_jobs')->selectRaw('*'),
            'failed_at'
        )->count();
    }

    private function sessions()
    {
        return DB::table('sessions')
            ->selectRaw('*')
            ->count();
    }

    private function serverTime()
    {
        return now()->format('H:i');
    }

    private function logSize()
    {
        $size = File::size(storage_path('logs/laravel.log'));

        return round($size / 1048576, 2);
    }

    private function version()
    {
        return config('enso.config.version');
    }

    private function status()
    {
        return app()->isDownForMaintenance()
            ? 'down'
            : 'up';
    }

    private function filter($query, $attribute = 'created_at')
    {
        return $query->when($this->params->filled('startDate'), function ($query) use ($attribute) {
            $query->where($attribute, '>=', $this->params->get('startDate'));
        })->when($this->params->filled('endDate'), function ($query) use ($attribute) {
            $query->where($attribute, '<=', $this->params->get('endDate'));
        });
    }

    private function params(array $params)
    {
        $params['dataTypes'] = json_decode($params['dataTypes']);

        return new Obj($params);
    }
}
