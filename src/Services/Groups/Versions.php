<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\MysqlVersion;
use LaravelEnso\ControlPanelApi\Services\Sensors\OperatingSystem;
use LaravelEnso\ControlPanelApi\Services\Sensors\PhpVersion;
use LaravelEnso\ControlPanelApi\Services\Sensors\Version;
use LaravelEnso\ControlPanelCommon\Contracts\Group;

class Versions implements Group
{
    public function id()
    {
        return 'versions';
    }

    public function label(): string
    {
        return 'Versions';
    }

    public function sensors(): array
    {
        return [
            Version::class, PhpVersion::class,
            MysqlVersion::class, OperatingSystem::class,
        ];
    }

    public function order(): int
    {
        return 300;
    }
}
