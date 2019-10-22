<?php

namespace LaravelEnso\ControlPanelApi\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Core\app\Models\Login;
use LaravelEnso\ActionLogger\app\Models\ActionLog;
use LaravelEnso\ControlPanelApi\app\Enums\DataTypes;

class Statistics
{
    private $startDate;
    private $endDate;
    private $dataTypes;

    public function __construct($params)
    {
        $format = config('enso.config.dateTimeFormat');

        $this->startDate = isset($params['startDate'])
            ? Carbon::createFromFormat($format, $params['startDate'])
            : null;

        $this->endDate = isset($params['endDate'])
            ? Carbon::createFromFormat($format, $params['endDate'])
            : null;

        $this->dataTypes = json_decode($params['dataTypes']);
    }

    public function handle()
    {
        return $this->requestIsValid()
            ? $this->statistics()
            : null;
    }

    private function statistics()
    {
        return collect($this->dataTypes)
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
        return $query->when($this->startDate, function ($query) use ($attribute) {
            $query->where($attribute, '>=', $this->startDate);
        })->when($this->endDate, function ($query) use ($attribute) {
            $query->where($attribute, '<=', $this->endDate);
        });
    }

    private function requestIsValid()
    {
        return collect($this->dataTypes)
            ->diff(DataTypes::keys())
            ->isEmpty();
    }
}
