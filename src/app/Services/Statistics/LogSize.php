<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\File;
use LaravelEnso\Helpers\App\Classes\Decimals;

class LogSize extends BaseSensor
{
    public function value()
    {
        return "{$this->logSize()} MB";
    }

    public function tooltip(): string
    {
        return 'size of log';
    }

    public function description(): ?string
    {
        return 'size of laravel log in MegaBytes';
    }

    public function icon()
    {
        return ['fad', 'terminal'];
    }

    public function order(): int
    {
        return 100;
    }

    private function logSize(): string
    {
        $size = File::size(storage_path('logs/laravel.log'));

        return Decimals::div($size, 1024 * 1024);
    }
}
