<?php

namespace LaravelEnso\ControlPanelApi\Services\Sensors;

use LaravelEnso\Users\Models\User;

class UserCount extends Sensor
{
    public function value(): mixed
    {
        $stats = $this->stats();

        return "{$stats->active} / {$stats->inactive}";
    }

    public function tooltip(): string
    {
        return 'active versus inactive users';
    }

    public function icon(): array
    {
        return ['fad', 'user-friends'];
    }

    public function order(): int
    {
        return 200;
    }

    private function stats()
    {
        return User::query()
            ->selectRaw('count(case when is_active = 1 then 1 end) as active')
            ->selectRaw('count(case when is_active = 0 then 1 end) as inactive')
            ->first();
    }
}
