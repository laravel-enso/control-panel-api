<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\Logins;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Requests;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Sessions;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Activity implements Group
{
    public function id()
    {
        return 'activity';
    }

    public function label(): string
    {
        return 'Activity';
    }

    public function sensors(): array
    {
        return [
            Logins::class, Requests::class, Sessions::class,
        ];
    }

    public function order(): int
    {
        return 500;
    }
}
