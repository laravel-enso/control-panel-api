<?php

namespace LaravelEnso\ControlPanelApi\App\Contracts;

interface Action
{
    public function id();

    public function handle();

    public function label(): string;

    public function tooltip(): string;

    public function description(): ?string;

    public function icon();

    public function confirmation(): bool;

    public function order(): int;
}
