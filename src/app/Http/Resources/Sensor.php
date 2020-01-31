<?php

namespace LaravelEnso\ControlPanelApi\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sensor extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id(),
            'value' => $this->value(),
            'icon' => $this->icon(),
            'tooltip' => __($this->tooltip()),
            'description' => __($this->description()),
            'class' => $this->class(),
            'order' => $this->order(),
        ];
    }
}
