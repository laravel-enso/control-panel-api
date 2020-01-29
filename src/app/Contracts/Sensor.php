<?php

namespace LaravelEnso\ControlPanelApi\App\Contracts;

interface Sensor
{
    public function id();

    public function value();

    public function tooltip(): string;

    public function description(): ?string;

    public function icon();

    public function class(): string;

    public function order(): int;
}
