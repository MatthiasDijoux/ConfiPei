<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class addProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $producer =  new ProducerResource($this->producers);
        $fruit =  new FruitResource($this->fruits);

        return [
            'name' => $this->name,
            'producer' => $producer->name,
            'prix'=>$this->prix, 
            'fruits'=>$this->fruits,
        ];
        }
}
