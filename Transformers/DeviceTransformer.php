<?php

namespace Modules\Traccar\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class DeviceTransformer extends JsonResource
{

    /**
    * Transform the resource into an array.
    *
    * @param Request  $request
    * @return array
    */

    public function toArray($request): array
    {
        $data = [
            'id' => $this->when($this->id, $this->id),
            'name' => $this->name,
            'imei' => $this->device_data->imei ?? '',
            'type' => $this->device_data->plate_number,
            'brand' => '',
            'model' => '',
            's_motor' => '',
            's_chassis' => ''
        ];

        return $data;

    }
}
