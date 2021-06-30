<?php

namespace LaravelEnso\ControlPanelApi\Services\Groups;

use LaravelEnso\ControlPanelApi\Services\Sensors\Database;
use LaravelEnso\ControlPanelApi\Services\Sensors\OperatingSystem;
use LaravelEnso\ControlPanelApi\Services\Sensors\PhpVersion;
use LaravelEnso\ControlPanelApi\Services\Sensors\Version;
use LaravelEnso\ControlPanelCommon\Contracts\Group;
use LaravelEnso\ControlPanelCommon\Services\IdProvider;

class Versions extends IdProvider implements Group
{
    public function label(): string
    {
        return 'Versions';
    }

    public function sensors(): array
    {
        return [
            Version::class, PhpVersion::class,
            Database::class, OperatingSystem::class,
        ];
    }

    public function order(): int
    {
        return 300;
    }
}
