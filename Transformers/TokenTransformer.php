<?php

namespace Modules\Traccar\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class TokenTransformer extends JsonResource
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
            'created_at' => $this->when($this->created_at, $this->created_at),
            'update_at' => $this->when($this->created_at, $this->created_at),
        ]

        $filter = json_decode($request->filter);

        if (isset($filter->allTranslations) && $filter->allTranslations) {

              $languages = \LaravelLocalization::getSupportedLocales();

              foreach ($languages as $lang => $value) {

              /* $data[$lang]['title'] = $this->hasTranslation($lang) ?
                        $this->translate("$lang")['title'] : '';*/


              }
        }

        return $data;

    }
}
