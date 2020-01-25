<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Responses;

use Illuminate\Http\Resources\Json\JsonResource;

class Action extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->label(),
            'icon' => $this->icon(),
            'description' => __($this->description()),
            'confirmation' => $this->confirmation(),
        ];
    }
}
