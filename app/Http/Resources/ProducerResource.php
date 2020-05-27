<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProducerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = new UsersResource($this->user);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'id_user' => $user,
        ];
    }
}
