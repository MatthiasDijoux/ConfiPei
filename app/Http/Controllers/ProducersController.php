<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProducerResource;
use App\Http\Resources\UsersResource;
use App\ProducerModel;
use App\User;

class ProducersController extends Controller
{
    public function getProducers()
    {
        $producers = ProducerModel::get();
        return ProducerResource::collection($producers);      
    }
}
