<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\Core\Services\Version as Service;
use LaravelEnso\Helpers\Services\Obj;

class Version extends Sensor
{
    private Service $version;

    public function __construct(Obj $params)
    {
        parent::__construct($params);

        $this->version = new Service();
    }

    public function class(): ?string
    {
        return $this->version->isOutdated() ? 'has-text-danger' : '';
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
