<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\App\Classes\DiskSize;

class LogSize extends Sensor
{
    public function value()
    {
        return DiskSize::forHumans($this->logSize());
    }

    public function tooltip(): string
    {
        return "size of the application's log";
    }

    public function icon(): array
    {
        return ['fad', 'terminal'];
    }

    public function order(): int
    {
        return 400;
    }

    private function logSize(): string
    {
        return File::size(storage_path('logs/laravel.log'));
    }
}
