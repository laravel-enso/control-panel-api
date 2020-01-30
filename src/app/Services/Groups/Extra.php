<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\LogSize;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ResponseTime;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\ServerTime;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Extra implements Group
{
    public function id()
    {
        return 'extra';
    }

    public function label(): string
    {
        return 'Extra';
    }

    public function statistics(): array
    {
        return [
            LogSize::class, ServerTime::class, ResponseTime::class,
        ];
    }

    public function order(): int
    {
        return 700;
    }
}
