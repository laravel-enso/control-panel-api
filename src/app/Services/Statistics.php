<?php

namespace LaravelEnso\ControlPanelApi\App\Services;

use Illuminate\Support\Collection;
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
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Schedule;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ServerTime;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Session;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Status;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\User;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Version;

class Statistics
{
    private array $stats = [
        'Statuses' => [
            Status::class, Schedule::class, Horizon::class,
        ],
        'Server' => [
            Load::class, Memory::class, Disk::class,
        ],
        'Users' => [
            NewUser::class, ActiveUser::class, User::class,
        ],
        'Version' => [
            MysqlVersion::class, PhpVersion::class, Version::class,
        ],
        'Login' => [
            Login::class, ActionLog::class, Session::class,
        ],
        'Jobs' => [
            Job::class, FailedJob::class,
        ],
        'Extra' => [
            LogSize::class, ServerTime::class,
        ],
    ];

    public function register($registers)
    {
        (new Collection(collect($registers)))
            ->each(fn ($stats, $group) => $this->stats[$group] = [
                ...($this->stats[$group] ?? []),
                ...$stats,
            ]);
    }

    public function all()
    {
        return $this->stats;
    }
}
