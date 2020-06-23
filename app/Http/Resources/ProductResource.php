<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //un seul producer donc New
        $producer =  new ProducerResource($this->whenLoaded('producers'));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'producer' => $producer,
            'rewards' => RewardResource::collection($this->whenLoaded('rewards')),
            'fruits' => FruitResource::collection($this->whenLoaded('fruits')),
            'prix' => $this->prix,
            'image' => $this->image,
            'quantite' => $this->quantite,
        ];
    }
}
