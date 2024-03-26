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
        $comment = explode(", ", preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $this->device_data->comment));
        if (isset($comment[0]) && !empty($comment[0])) {
            foreach ($comment as $item) {
                $item = explode(':', $item);
                switch ($item[0]) {
                    case 'imei':
                        $data['imei'] = $item[1];
                        break;
                    case 'marca':
                        $data['brand'] = $item[1];
                        break;
                    case 'modelo':
                        $data['model'] = $item[1];
                        break;
                    case 'serialMotor':
                        $data['s_motor'] = $item[1];
                        break;
                    case 'serialChassis':
                        $data['s_chassis'] = $item[1];
                        break;
                    default;
                        $data[$item[0] ?? 'default'] = $item[1] ?? 'N/A';
                }

            }
        }
        return $data;
    }
}
