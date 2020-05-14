<?php

namespace App\Http\Controllers;

use App\FruitModel;
use App\Http\Resources\addProductResource;
use App\Http\Resources\ProductResource;
use App\ProducerModel;
use App\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    function index()
    {
        return view('home.main');
    }
    function getProduct()
    {
        $products =  ProductModel::with([
            'producers',
            'rewards',
            'fruits',
        ])->get();
        return  ProductResource::collection($products);
    }


    function createOrUpdate(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "prix" => "required",
                "id_producer" => "required|numeric",
                "fruits" => "",
                "id" => "",
                "oldFruit"=>"",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $product = ProductModel::find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new ProductModel;
            Log::debug('CreateProduct');
        } else {
            $addToDb = $product;
            Log::debug('UpdateProduct');
        }



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
                }
            }
        }
        if (!empty($fruits)) {
            $addToDb->fruits()->attach($fruits);
        }
        /* withPivot, if exist detach else attach
         */
        $pivot = ProductModel::wherePivotIn('id_fruit', '=', '1')->get();
        return ($pivot);
    }
}
