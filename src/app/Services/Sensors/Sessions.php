<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Illuminate\Support\Facades\DB;

class Sessions extends Sensor
{
    public function value()
    {
        return DB::table('sessions')
            ->selectRaw('user_id')
            ->count();
    }

    public function tooltip(): string
    {
        return 'session count';
    }

    public function icon(): array
    {
        return ['fad', 'link'];
    }

    public function order(): int
    {
        return 300;
    }
}
