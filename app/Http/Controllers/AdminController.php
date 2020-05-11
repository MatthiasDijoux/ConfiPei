<?php

namespace App\Http\Controllers;

use App\FruitModel;
use App\Http\Resources\addProductResource;
use App\ProducerModel;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('home.main');
    }
    function addProduct(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "prix" => "required",
                "id_producer" => "required|numeric",
                "fruits" => ""
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();

        $addToDb = new ProductModel;
        $addToDb->name = $datasToAdd['name'];
        $addToDb->prix = $datasToAdd['prix'];
        $producer = ProducerModel::find($datasToAdd['id_producer']);
        if (!$producer) {
            return 'err';
        }
        $addToDb->producers()->associate($producer);
        $addToDb->save();


        $fruits = [];
        if (is_array($datasToAdd['fruits'])) {
            foreach ($datasToAdd['fruits'] as $_fruit) {
                if (isset($_fruit['id'])) {
                    $fruit = FruitModel::find($_fruit['id']);
                    if (!$fruit) {
                        return 'err';
                    }
                    $fruits[] = $fruit->id;
                } else {
                    return "id existe pas";
                    //On va créer un objet par la suite fruit:{name:""}
                }
            }
        }
        if (!empty($fruits)) {
            $addToDb->fruits()->attach($fruits);
        }

        return new addProductResource($addToDb);
    }

    function updateProduct(Request $request, $id)
    {
        $dataUpdate = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "producer" => "required",
                "fruits" => "required",
                "prix" => "required",
            ]
        )->validate();

        $Producer = ProductModel::where('id', '=', $id)
            ->first();
            if (!$Producer){
                return "err";
            }
            else{
                $Producer->nom = $dataUpdate['nom'];
                $Producer->producer = $dataUpdate['producer'];
                $Producer->prix = $dataUpdate['prix'];
                $Producer->save();
            }


        return ($data);
    }
}
