<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProducerResource;
use App\ProducerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProducersController extends Controller
{
    public function index(Request $request)
    {
        $data = Validator::make(
            $request->input(),
            [
                'id' => 'required'
            ]
        )->validate();
        $producer = ProducerModel::find($data['id']);
        return $producer;
    }
}
