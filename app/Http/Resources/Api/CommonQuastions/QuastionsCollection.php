<?php

namespace App\Http\Resources\Api\CommonQuastions;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuastionsCollection extends ResourceCollection
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
            'status' => true,
            'code' => 200,
            'message' => 'Success',
            'data' =>$this->collection,
        ];
       
    }
}
