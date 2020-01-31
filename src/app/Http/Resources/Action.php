<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Action extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id(),
            'label' => $this->label(),
            'icon' => $this->icon(),
            'tooltip' => __($this->tooltip()),
            'description' => __($this->description()),
            'confirmation' => $this->confirmation(),
            'order' => $this->order(),
        ];
    }
}
