<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Statistics;

use Illuminate\Support\Facades\DB;

class Session extends BaseSensor
{
    public function value()
    {
        return DB::table('sessions')
            ->selectRaw('user_id')
            ->count();
    }

    public function tooltip(): string
    {
        return 'sessions';
    }

    public function description(): ?string
    {
        return 'number of sessions';
    }

    public function icon()
    {
        return ['fad', 'link'];
    }

    public function order(): int
    {
        return 300;
    }
}
