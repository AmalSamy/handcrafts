<?php

namespace App\Http\Resources\Api\Services;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_ar' => $this->getTranslation('name', 'ar'),
            'name_en' =>$this->getTranslation('name', 'en'),
            'price' => $this->price,
            'discount' => $this->discount_price,
            'time' => $this->time,
        ];
       
    }
}
