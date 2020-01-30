<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Groups;

use LaravelEnso\ControlPanelApi\App\Services\Statistics\MysqlVersion;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\PhpVersion;
use LaravelEnso\ControlPanelApi\App\Services\Statistics\Version as Stat;
use LaravelEnso\ControlPanelCommon\App\Contracts\Group;

class Version implements Group
{
    public function id()
    {
        return 'version';
    }

    public function label(): string
    {
        return 'Version';
    }

    public function statistics(): array
    {
        return [
            MysqlVersion::class, PhpVersion::class, Stat::class,
        ];
    }

    public function order(): int
    {
        return 400;
    }
}
