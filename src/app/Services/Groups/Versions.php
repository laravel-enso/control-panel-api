<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Sensors\MysqlVersion;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\PhpVersion;
use LaravelEnso\ControlPanelApi\App\Services\Sensors\Version;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

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
            Version::class, PhpVersion::class, MysqlVersion::class,
        ];
    }

    public function order(): int
    {
        return 300;
    }
}
