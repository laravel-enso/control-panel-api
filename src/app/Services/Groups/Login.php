<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\ActionLog;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Login as Stat;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Session;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Login implements Group
{
    public function id()
    {
        return 'login';
    }

    public function label(): string
    {
        return 'Login';
    }

    public function statistics(): array
    {
        return [
            Stat::class, ActionLog::class, Session::class,
        ];
    }

    public function order(): int
    {
        return 500;
    }
}
