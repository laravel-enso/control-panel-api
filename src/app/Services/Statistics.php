<?php

namespace LaravelEnso\ControlPanelApi\app\Services;

use Carbon\Carbon;
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
        $this->startDate = isset($params['startDate'])
            ? Carbon::parse($params['startDate'])->format('Y-m-d')
            : null;

        $this->endDate = isset($params['endDate'])
            ? Carbon::parse($params['endDate'])->format('Y-m-d')
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
                $attribute = camel_case($type);
                $response[$attribute] = $this->{$attribute}();

                return $response;
            }, []);
    }

    private function logins()
    {
        $logins = Login::query();

        if ($this->startDate) {
            $logins->where('created_at', '>', $this->startDate);
        }

        if ($this->endDate) {
            $logins->where('created_at', '<', $this->endDate);
        }

        return $logins->count();
    }

    private function actions()
    {
        $actionLogs = ActionLog::query();

        if ($this->startDate) {
            $actionLogs->where('created_at', '>', $this->startDate);
        }

        if ($this->endDate) {
            $actionLogs->where('created_at', '<', $this->endDate);
        }

        return $actionLogs->count();
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
        $users = User::query();

        if ($this->startDate) {
            $users->where('created_at', '>', $this->startDate);
        }

        if ($this->endDate) {
            $users->where('created_at', '<', $this->endDate);
        }

        return $users->count();
    }

    private function failedJobs()
    {
        $query = DB::table('failed_jobs')
                    ->selectRaw('*');

        if ($this->startDate) {
            $query->where('failed_at', '>', $this->startDate);
        }

        if ($this->endDate) {
            $query->where('failed_at', '<', $this->endDate);
        }

        return $query->count();
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

    private function requestIsValid()
    {
        return collect($this->dataTypes)
            ->diff(DataTypes::keys())
            ->isEmpty();
    }
}
