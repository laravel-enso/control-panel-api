<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use LaravelEnso\ControlPanelApi\App\DTOs\Group;
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
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ResponseTime;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Schedule;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ServerTime;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Session;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Status;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\User;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Version;

class Statistics
{
    private array $stats = [];

    public function register($registers)
    {
        $this->stats = [
            ...$this->stats,
            ...$registers,
        ];
    }

    public function all()
    {
        return [
            ...$this->initStats(),
            ...$this->stats,
        ];
    }

    private function initStats(): array
    {
        return [
            new Group('statuses', 'Statuses', [
                Status::class, Schedule::class, Horizon::class,
            ]),
            new Group('server', 'Server', [
                Load::class, Memory::class, Disk::class,
            ]),
            new Group('users', 'Users', [
                NewUser::class, ActiveUser::class, User::class,
            ]),
            new Group('version', 'Version', [
                MysqlVersion::class, PhpVersion::class, Version::class,
            ]),
            new Group('login', 'Login', [
                Login::class, ActionLog::class, Session::class,
            ]),
            new Group('jobs', 'Jobs', [
                Job::class, FailedJob::class,
            ]),
            new Group('extra', 'Extra', [
                LogSize::class, ServerTime::class, ResponseTime::class,
            ]),
        ];
    }
}
