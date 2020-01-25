<?php

namespace LaravelEnso\ControlPanelApi\App\Contracts;

interface Sensor
{
    //TODO add an id() that we could use in fornt-end as :key
    //TODO add tooltip()

    public function value();

    public function description(): string;

    public function icon();

    public function class(): string;
}
