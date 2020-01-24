<?php

namespace LaravelEnso\ControlPanelApi\App\Contracts;

interface Action
{
    public function handle();

    public function label(): string;

    public function description(): string;

    public function icon();

    public function confirmation(): bool;
}
