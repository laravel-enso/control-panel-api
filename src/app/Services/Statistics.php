<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use LaravelEnso\ControlPanelApi\App\Contracts\Statistics as Contract;
use LaravelEnso\ControlPanelApi\App\Enums\DataTypes;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ActionLog;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ActiveUser;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Disk;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\FailedJob;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Horizon;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Job;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Load;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Login;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\LogSize;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Memory;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\MysqlVersion;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\NewUser;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\PhpVersion;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\QueueSize;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Schedule;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ServerTime;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Session;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Status;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\User;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Version;
use LaravelEnso\Helpers\App\Classes\Obj;

class Statistics
{
    private static array $stats = [
        DataTypes::Logins => Login::class,
        DataTypes::Actions => ActionLog::class,
        DataTypes::FailedJobs => FailedJob::class,
        DataTypes::Jobs => Job::class,
        DataTypes::Horizon => Horizon::class,
        DataTypes::Sessions => Session::class,
        DataTypes::Users => User::class,
        DataTypes::ActiveUsers => ActiveUser::class,
        DataTypes::NewUsers => NewUser::class,
        DataTypes::ServerTime => ServerTime::class,
        DataTypes::Version => Version::class,
        DataTypes::PhpVersion => PhpVersion::class,
        DataTypes::Schedule => Schedule::class,
        DataTypes::MysqlVersion => MysqlVersion::class,
        DataTypes::Disk => Disk::class,
        DataTypes::Load => Load::class,
        DataTypes::Memory => Memory::class,
        DataTypes::LogSize => LogSize::class,
        DataTypes::Status => Status::class,
        DataTypes::QueueSize => QueueSize::class,
    ];

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

    public static function addStat($dataType, Contract $stat)
    {
        static::$stats[$dataType] = $stat;
    }

    private function statistics()
    {
        return $this->params->get('dataTypes')
            ->reduce(fn ($response, $type) => $response
                ->put(Str::camel($type), $this->stat($type)->handle()), new Collection());
    }

    private function stat($type): Contract
    {
        return App::makeWith(static::$stats[$type], [
            'params' => $this->params,
        ]);
    }

    private function requestIsValid()
    {
        return $this->params->get('dataTypes')
            ->diff(collect(static::$stats)->keys())
            ->isEmpty();
    }

    private function params(array $params)
    {
        $params['dataTypes'] = json_decode($params['dataTypes']);

        return new Obj($params);
    }
}
