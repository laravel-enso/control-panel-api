<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\NewUsers;
use LaravelEnso\ControlPanelApi\Services\Sensors\UserCount;
use LaravelEnso\ControlPanelApi\Services\Sensors\UserGroups;
use LaravelEnso\ControlPanelCommon\Contracts\Group;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;

class Users extends IdProvider implements Group
{
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
