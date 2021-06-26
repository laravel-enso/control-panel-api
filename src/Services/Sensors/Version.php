<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\Core\Services\Version as Service;

class Version extends Sensor
{
    private Service $version;

    public function __construct()
    {
        parent::__construct(...func_get_args());

        $this->version = new Service();
    }

    public function class(): ?string
    {
        return $this->version->isOutdated() ? 'is-danger' : '';
    }

    public function value(): mixed
    {
        return $this->version->current();
    }

    public function tooltip(): string
    {
        return 'enso version';
    }

    public function icon(): array
    {
        return ['fab', 'enso'];
    }

    public function order(): int
    {
        return 100;
    }
}
