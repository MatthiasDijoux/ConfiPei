<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProducerResource;
use App\ProducerModel;

class ProducersController extends Controller
{
    public function getProducers()
    {
        $producers = ProducerModel::get();
        return ProducerResource::collection($producers);      
    }
}
