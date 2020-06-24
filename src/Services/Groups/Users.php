<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\NewUsers;
use LaravelEnso\ControlPanelApi\Services\Sensors\UserCount;
use LaravelEnso\ControlPanelApi\Services\Sensors\UserGroups;
use LaravelEnso\ControlPanelCommon\Contracts\Group;

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
        return 400;
    }
}
