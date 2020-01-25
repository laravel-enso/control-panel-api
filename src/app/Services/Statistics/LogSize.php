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

    public function description(): string
    {
        return 'size of log';
    }

    public function icon()
    {
        return 'terminal';
    }

    private function logSize(): string
    {
        $size = File::size(storage_path('logs/laravel.log'));

        return Decimals::div($size, 1024 * 1024);
    }
}
