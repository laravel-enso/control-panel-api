<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\NewUsers;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\UserCount;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\UserGroups;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Users implements Group
{
    public function id()
    {
        return 'users';
    }

    public function label(): string
    {
        return 'Users';
    }

    public function sensors(): array
    {
        return [
            NewUsers::class, UserCount::class, UserGroups::class,
        ];
    }

    public function order(): int
    {
        return 300;
    }
}
