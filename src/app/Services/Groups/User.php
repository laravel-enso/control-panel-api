<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\ActiveUser;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\NewUser;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\User as UserStat;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class User implements Group
{
    public function id()
    {
        return 'user';
    }

    public function label(): string
    {
        return 'User';
    }

    public function statistics(): array
    {
        return [
            NewUser::class, ActiveUser::class, UserStat::class,
        ];
    }

    public function order(): int
    {
        return 300;
    }
}
