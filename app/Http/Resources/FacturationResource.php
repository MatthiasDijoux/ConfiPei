<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacturationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pays' => $this->pays,
            'ville' => $this->ville,
            'code_postal' => $this->code_postal,
            'adresse' => $this->adresse,
        ];
    }
}
