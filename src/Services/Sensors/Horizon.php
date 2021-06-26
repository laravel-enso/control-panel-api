<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class Horizon extends Sensor
{
    public function value(): mixed
    {
        return 'Horizon';
    }

    public function tooltip(): string
    {
        return 'horizon status';
    }

    public function icon(): array
    {
        return match ($this->status()) {
            'running' => ['fad', 'check-circle'],
            'paused' => ['fad', 'pause-circle'],
            default => ['fad', 'times-circle'],
        };
    }

    public function class(): ?string
    {
        return match ($this->status()) {
            'running' => 'has-text-success',
            'paused' => 'has-text-warning',
            default => 'has-text-danger',
        };
    }

    public function order(): int
    {
        return 300;
    }

    private function status(): string
    {
        $masters = App::make(MasterSupervisorRepository::class)->all();

        if (! $masters) {
            return 'inactive';
        }

        return Collection::wrap($masters)
            ->contains(fn ($master) => $master->status === 'paused')
            ? 'paused'
            : 'running';
    }
}
