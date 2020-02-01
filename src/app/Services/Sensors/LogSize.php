<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\App\Classes\Decimals;

class LogSize extends Sensor
{
    public function value()
    {
        return "{$this->logSize()} MB";
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
        $size = File::size(storage_path('logs/laravel.log'));

        return Decimals::div($size, 1024 * 1024);
    }
}
