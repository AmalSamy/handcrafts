<?php

namespace App\Http\Resources\Api\CommonQuastions;

use Illuminate\Http\Resources\Json\JsonResource;

class QuastionsResource extends JsonResource
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
            'title' => $this->title,
            'desc'=> $this->desc ,
        ];
    }
}
