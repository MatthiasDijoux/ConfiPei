<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProducerResource;
use App\ProducerModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProducersController extends Controller
{
    public function getProducers()
    {
        $producers = ProducerModel::get();
        return ProducerResource::collection($producers);
    }
    public function addOrUpdate(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "id" => "",
                "id_user" => "",
                "username" => "",
                "mail" => "",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $producer = ProducerModel::find($datasToAdd['id']);
        if ($producer) {
            $producer->name = $datasToAdd['name'];
            $producer->save();
        } else {
            throw 'err';
        }
        $user = User::find($datasToAdd['id_user']);
        if ($user) {

            $user->username = $datasToAdd['username'];
            $user->mail = $datasToAdd['mail'];
            $user->save();
        } else {
            throw 'err';
        }
        return new ProducerResource($producer);
    }
}
