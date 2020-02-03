<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Sessions extends Sensor
{
    public function value()
    {
        return DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', $this->limit())
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

    private function limit()
    {
        $lifetime = Config::get('session.lifetime');

        return Carbon::now()->subMinutes($lifetime)->timestamp;
    }
}
